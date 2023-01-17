@extends('link')

@section('content')

<table style="margin-top: 30px ;" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Full Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Department</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allData as $data) { ?>
            <tr>
                <td><?php echo $data['0'] ?></td>
                <td><?php echo $data['1'] ?></td>
                <td><?php echo $data['2'] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

@endsection