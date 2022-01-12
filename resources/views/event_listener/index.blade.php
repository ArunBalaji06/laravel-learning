<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Listener</title>

    <!-- Bootstrap 5 style-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>
    <div class="container">
        <h2 class='text-center'>Event And Listener<h2><br>
        <div class='row col-md-12'>
        <!-- Form for users -->
            <div class='card col-md-3'>
                <div class='card-header'>
                    <h3 class='text-center'>User Form</h3>
                </div>
                <div class='card-body'>
                    <form action="{{ route('el.store') }}" method="POST">
                    @csrf
                        <label class='fs-6 fw-light'>Name: <label>
                        <input type='text' name='name' class='form-control'>
                        <label class='fs-6 fw-light'>Email: <label>
                        <input type='email' name='email' class='form-control'>
                        <label class='fs-6 fw-light'>Password: <label>
                        <input type='passowrd' style name='password' class='form-control'><br>
                        <button type='submit' class='btn btn-primary'>Submit</button>
                    </form>
                </div>
            </div>
        <!-- <div class="col-md-1"></div> -->
            <!-- Table -->
            <div class='col-md-8'>
                <div class='card'>
                    <div class='card-header'>
                        <h3 class='text-center'>User Table</h3>
                    </div>
                    <div class='card-body'>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <td class='fs-4'>Name</td>
                                <td class='fs-4'>Email</td>
                                <td class='fs-4'>In Time</td>
                                <td class='fs-4'>Out Time</td>
                                <td class='fs-4'>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class='fs-5'>{{ $user->name }}</td>
                                    <td class='fs-5'>{{ $user->email }}</td>
                                    <td class='fs-5'>{{ $user->logged_in }}</td>
                                    <td class='fs-5'>{{ $user->logged_out }}</td>
                                    @if(!isset($user->logged_out))
                                    <td>
                                        <a href="{{ route('el.delete', [$user->id] ) }}" class='btn btn-warning'>Delete</a>
                                    </td>
                                    @else
                                    <td>
                                        <button class='btn btn-info'>Deleted</button>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 script -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>