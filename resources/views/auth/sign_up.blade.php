<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstarp -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <title>Chat | Sign-Up</title>
</head>
<body>
    <br/><br/>
    <div class="container col-md-12">

        <h2 class="text-center">Chat | Registration</h2><br/>
        <div class="col-md-6 card" style="margin-left:300px;">
            <div class="col-md-11 p-2">
                <form method="post" action="/register">
                    @csrf
                    Name:<br />
                    <input type="text" class="form-control" name="name">
                    Email:<br />
                    <input type="text" class="form-control" name="email">
                    Password:<br />
                    <input type="text" class="form-control" name="password">
                    <button type="submit" class="btn btn-primary btn-submit">Register</button>
                </form>
            </div>
        </div>

    </div>
        
    
</body>
</html>