<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactDepartment;
use App\Models\Department;
use Session;
use Illuminate\Support\Facades\DB;
use LengthException;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(5);

        return view('contact.index', compact('contacts'));
    }
    public function create()
    {
        return view('contact.create');
    }
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('contact.create', compact('contact'));
    }
    public function department($id)
    {
        $contact = Contact::find($id);
        $department = Department::all();
        $data = [
            'contact'  => $contact,
            'departments'   => $department,
        ];
        return view('contact.chooseDepartment', $data);
    }
    public function saveContact(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);
        if ($request->get('id') != '') {
            $contact = Contact::find($request->get('id'));
            $contact->name =  $request->get('name');
            $contact->phone = $request->get('phone');
        } else {
            $contact = new Contact([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
            ]);
        }
        $contact->save();
        return redirect('/index_contact');
    }
    public function saveDepartment(Request $request)
    {
        $departments = $request->get('department_id');
        foreach ($departments as $department) {
            $contact_department = new ContactDepartment([
                'contact_id' => $request->get('contact_id'),
                'department_id' => $department,
            ]);
            $contact_department->save();
        }

        return redirect('/index_contact');
    }
    public function delete($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return redirect('/index_contact');
    }
    public function contact_depart(Request $request)
    {
        return view('contact.contactDepartment');
    }

    public function index_contactDepartment()
    {
        $allData = [];
        $contacts =  Contact::with('department')->get();
        for ($i = 0; $i < count($contacts); $i++) {
            foreach ($contacts[$i]->department as $contact) {
                $name = $contacts[$i]->name;
                $phone = $contacts[$i]->phone;
                $department = $contact->name;
                $data = array($name, $phone, $department);
                array_push($allData, $data);
            }
        }
        return view('contactDepartment.index', compact('allData'));
    }

    public function get_search()
    {
        $search = $_GET['search'];
        $column = $_GET['column'];

        $searchData = [];
        $contacts =  Contact::with('department')->get();
        for ($i = 0; $i < count($contacts); $i++) {
            foreach ($contacts[$i]->department as $contact) {
                $name = $contacts[$i]->name;
                $phone = $contacts[$i]->phone;
                $department = $contact->name;
                if ($column == "1") {
                    if (str_contains($name, $search)) {
                        $searchName = array($name, $phone, $department);
                        array_push($searchData, $searchName);
                    }
                } else if ($column == "2") {
                    if (str_contains($phone, $search)) {
                        $searchPhone = array($name, $phone, $department);
                        array_push($searchData, $searchPhone);
                    }
                } else if ($column == "3") {
                    if (str_contains($department, $search)) {
                        $searchDepartment = array($name, $phone, $department);
                        array_push($searchData, $searchDepartment);
                    }
                }
            }
        }
        foreach ($searchData as $data) {
            echo "<tr> 
            <td>{$data[0]}</td>
            <td>{$data[1]}</td>
            <td>{$data[2]}</td>
            </tr>";
        }
    }

    public function uploadFile(Request $request)
    {

        if ($request->input('submit') != null) {

            $file = $request->file('file');
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
            // Valid File Extensions
            $valid_extension = array("csv");
            // 2MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {

                // Check file size
                if ($fileSize <= $maxFileSize) {

                    // File upload location
                    $location = 'uploads';

                    // Upload file
                    $file->move($location, $filename);

                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);

                    // Reading file
                    $file = fopen($filepath, "r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);

                        // Skip first row (Remove below comment if you want to skip the first row)
                        /*if($i == 0){
                $i++;
                continue; 
             }*/
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // Insert to MySQL database
                    foreach ($importData_arr as $importData) {

                        $contact = new Contact([
                            'name' => $importData[0],
                            'phone' => $importData[1],
                        ]);

                        $contact->save();
                    }
                }
            }
        }

        // Redirect to index
        return redirect('/index_contact');
    }
}
