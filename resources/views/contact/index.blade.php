@extends('link')

@section('content')
<div class="container-fluid" style="margin: 20px;" > 
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <a  type="button" href="http://127.0.0.1:8000/contact_create" class="btn btn-primary">New Contact</a>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
            <form method='post' action='/uploadFile' enctype='multipart/form-data'>
                {{ csrf_field() }}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <input type='file' name='file'>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                            <input type='submit' name='submit' value='Import'>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<table style="margin-top: 30px ;" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Department</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contacts as $contact) { ?>
            <tr>
                <td><?php echo $contact['id'] ?></td>
                <td><?php echo $contact['name'] ?></td>
                <td><?php echo $contact['phone'] ?></td>
                <td><a type="button" href="{{url('choose_department',$contact->id )}}" class="btn btn-primary">Choose Department</a></td>
                <td><a type="button" href="{{url('edit_contact',$contact->id )}}" class="btn btn-primary">Edit</a><a style="margin-left: 10px;" type="button" href="{{url('delete_contact',$contact->id )}}" class="btn btn-danger">Delete</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<div style="float:right;" class="d-flex">
    {!! $contacts->links() !!}
</div>
@endsection