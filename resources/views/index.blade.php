<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Observer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <br>
    <h3 class="text-center">Observer</h3>
    <div class="container">
        <div class="row">
            <div class="card col-md-3">
                <div class="card-header">
                    Form
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('observer.store') }}">
                        @csrf
                        Name: 
                        <input type="text" class="form-control" name="name">
                        Email:
                        <input type="text" class="form-control" name="email">
                        <br>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
<div class="col-md-1"></div>
            <!-- Table -->
            <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Updated Count</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->slug}}</td>
                        <td>{{$user->updated_count}}</td>
                        <td>
                            <!-- <a href="{{ route('observer.update',[$user->id]) }}" class="btn btn-primary">Update</a> -->


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}">
                        Update
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update user</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('observer.update', [$user->id]) }}">
                                    @csrf
                                    Name: 
                                    <input type="text" class="form-control" value="{{$user->name}}" name="name">
                                    Email:
                                    <input type="text" class="form-control" value="{{$user->email}}" name="email">
                                    <br>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>


                            <button class="btn btn-warning">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>