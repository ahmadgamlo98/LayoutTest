@extends('link')

@section('content')
<a style="margin-top: 10px;" type="button" href="http://127.0.0.1:8000/department_create" class="btn btn-primary">New Department</a>

<table style="margin-top: 30px ;" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Department Name</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($departments as $department) { ?>
            <tr>
                <td><?php echo $department['id'] ?></td>
                <td><?php echo $department['name'] ?></td>
                <td><a type="button" href="{{url('edit_department',$department->id )}}" class="btn btn-primary">Edit</a><a style="margin-left: 10px;" type="button" href="{{url('delete_department',$department->id )}}" class="btn btn-danger">Delete</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<div style="float:right;" class="d-flex">
    {!! $departments->links() !!}
</div>
@endsection