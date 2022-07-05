<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe || Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link rel="shortcut icon" href="#">
    
</head>


<body>
    <br>
    <div class="container col-md-6 card my-3 mx-6">
        <label>Name:</label>
        <input id="card-holder-name" type="text" class="form-control">

        <br>
        <!-- Stripe Elements Placeholder -->
        <div id="card-element" class="form-control">

        </div>
        <br>
        
        <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-success">
            Update Payment Method
        </button>
        <br>
    </div>
    
</body>
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ config("app.stripe_pk") }}');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    const userId = {{$id}};
 
    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    
    cardButton.addEventListener('click', async (e) => {
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value },
                }
            }
        );
        console.log(setupIntent.payment_method);
    
        if (error) {
            console.log('error');
        } else {
            console.log('success');
        }

        $.ajax({
        url: "{{url('/')}}/post-payment-method",   
        type:"POST",
        data:{
          userId: userId,
          name:cardHolderName.value,
          paymentMethodIntent:setupIntent.id,
          paymentMethod: setupIntent.payment_method,
        },
        success:function(response){
          console.log(response);
          if(response) {
            console.log(response);
          }
        },
        error: function(error) {
         console.log(error);
        }
       });
    });
</script>