<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactDepartment;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::paginate(2);

        return view('department.index', compact('departments'));
    }
    public function create()
    {
        return view('department.create');
    }
    public function edit($id)
    {
        $department = Department::find($id);
        return view('department.create', compact('department'));
    }
    public function saveDepartment(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);
        if ($request->get('id') != '') {
            $department = Department::find($request->get('id'));
            $department->name =  $request->get('name');
        } else {
            $department = new Department([
                'name' => $request->get('name'),
            ]);
        }
        $department->save();
        return redirect('/index_department');
    }
    public function delete($id)
    {
        $department = Department::find($id);
        $department->delete();

        return redirect('/index_department');
    }
}
