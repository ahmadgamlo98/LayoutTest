@extends('link')

@section('content')
<form action="{{url('save_contactdepartment')}}" method="POST">
    @csrf
    <input type="hidden" name="contact_id" value="{{$contact->id??""}}">
    <label for="cars">Choose Department:</label>
    <!-- <select name="department_id[]" id="department_id" multiple> -->
    <div class="col-md-3">
        <select class="form-select" multiple aria-label="multiple select example">
            <?php foreach ($departments as $department) { ?>
                <option value="{{$department->id??""}}">{{$department->name??""}}</option>
            <?php } ?>
        </select>
    </div>
    <br><br>
    <button type="submit" style="margin-left: 280px;" class="btn btn-primary">Save</button>
</form>
<p>Message:</p><p> Please hold CTRL and click on department to choose multiple one. </p>

@endsection