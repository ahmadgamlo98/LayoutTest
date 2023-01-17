@extends('link')

@section('content')
<div class="col-md-12">
    <div class="col-md-1"></div>
    <div class="col-md-11">
        <h4>Create Department</h4>
        <form action="{{url('save_department')}}" method="POST">
            @csrf
            <input type="hidden" class="form-control" id="id" name="id" value="{{$department->id??""}}">
            <div class="col-md-3" style="margin-top: 15px;">
                <label class="form-label">Full Name</label>
                <input class="form-control" id="name" name="name" placeholder="Enter Department Name" value="{{$department->name??""}}" required>
            </div>
            <button type="submit" style="margin-top: 10px;" class="btn btn-primary">Add Department</button>
        </form>
    </div>
</div>
@endsection