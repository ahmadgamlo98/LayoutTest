@extends('link')

@section('content')
<div class="col-md-12">
    <div class="col-md-1"></div>
    <div class="col-md-11">
        <h4>Create Contact</h4>
        <form action="{{url('save_contact')}}" method="POST">
            @csrf
            <input type="hidden" class="form-control" id="id" name="id" value="{{$contact->id??""}}">
            <div class="col-md-3" style="margin-top: 15px;">
                <label class="form-label">Full Name</label>
                <input class="form-control" id="name" name="name" placeholder="Enter your Full Name" value="{{$contact->name??""}}" required>
            </div>
            <div class="col-md-3" style="margin-top: 15px;">
                <label class="form-label">Phone Number</label>
                <input class="form-control" id="phone" name="phone" placeholder="Enter your Phone Number" value="{{$contact->phone??""}}" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Contact</button>
        </form>
    </div>
</div>
@endsection