<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat | Users</title>


    <!-- Bootstarp -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Chat</title>
</head>
<body>
<br />
    <div class="container">
    <div class="row">
            <div class="col-md-10 text-center">
                <h2>Chat</h2>
            </div>

            <div class="col-md-2 text-center">
                <a class="btn btn-warning" href="/logout">logout</a>
            </div>
        </div>

        <div class="col-md-4">
            @foreach($users as $user)
                <div class="card">
                    <div class="row">
                        <input type="hidden" id="user_id" value="{{$user->id}}">
                        <div class="col-md-8">{{$user->name}}</div>
                        <div class="col-md-4"><a class="btn btn-info" href="/chat/{{$user->id}}" type="button">chat</a></div>
                    </div>
                    
                </div>
            @endforeach
        </div>

    </div>
        
    
</body>
</html>