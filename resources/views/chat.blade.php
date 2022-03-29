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
    <title>Chat</title>

    
</head>
<body>
    <div class="container col-md-12">
        <br />
        <div class="row">
            <div class="col-md-10 text-center">
                <h2>Chat</h2>
            </div>

            <div class="col-md-2 text-center">
                <a class="btn btn-warning" href="/logout">logout</a>
            </div>
        </div>

        

        <div class="row col-md-12">
            
            <div class="col-md-8">

                <div id="to" style="max-height"> </div>

                <form id="form" class="form-control p-2" method="post">
                    <input type="hidden" value="{{$id}}" name="receiver_id">
                    <input type="text" class="col-md-9" name="message">
                    <button type="submit" class="btn btn-primary btn-submit col-md-2" style="margin-left:20px;max-height:35px">Send</button>
                </form>

            </div>
            
        </div>
        
        

    </div>

    

    
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">

    
   
    $(".btn-submit").click(function(e){
        e.preventDefault();
   
        var message = $("input[name=message]").val();
        var receiverId = $("input[name=receiver_id]").val();


        $("#from").append("<b style='margin-right:0px'>"+message+"</b>");

   
        $.ajax({
           type:'POST',
           url:"/send",
           data:{"data":message, "receiver_id":receiverId, "_token":"{{ csrf_token()}}"},
        });
  
    });
</script>                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        <script>

            Echo.channel('home')
                .listen('NewMessage', (e) => {
                    var from = e.data;
                    var to = from.replace('message=','');
                    $("#to").append("<b>"+to+"</b><br />");
                    $("input[name=message]").val('');

                })                        
        </script>
</html>