<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notification | Laravel</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3 class="text-center">Laravel Notification</h3><br>
        <div class="row">
            <div class="card col-md-4">
                <div class="card-header">
                    <h4 class="text-center">Register</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('notification.create') }}">
                        @csrf
                        Name:<br>
                        <input class="form-control" name="name" type="text">
                        Email:<br>
                        <input class="form-control" name="email" type="email">
                        Passowrd:<br>
                        <input class="form-control" name="password" type="password">
                        <br>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        <!-- Button trigger modal -->
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Send Notification
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Notification Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="{{ route('notification.send') }}">
                                @csrf
                                Details:<br>
                                <textarea class="form-control" name="details" type="text"></textarea>
                                <br>
                                <button class="btn btn-primary" type="submit">Send</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <h2>Notifications sent users</h2>
            <div class="col-md-6"></div>
            <div class="col-md-4">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Id</td>
                        </tr>
                    </thead>  
                    <tbody>
                        @foreach($notifiers as $notified)
                        <tr>
                            <td>{{ $notified->name}}</td>
                            <td>{{ $notified->data}}</td>
                        </tr>
                        @endforeach
                    </tbody>  
                <table>
            </div>
            <!-- <div class="col-md-4"></div> -->
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>