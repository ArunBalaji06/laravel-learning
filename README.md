# laravel-learning

## Reference video - 
*https://www.youtube.com/watch?v=pIGy7-7gGXI*

# Laravel Websockets

**Composer** package to install:
```
    composer require beyondcode/laravel-websockets
```

Next publish the migration file:
```
    php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
```

Then migrate the migration file to **DB**(mysql)
```
    php artisan migrate
```

Next publish the required configuration files for websockets:
```
    php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"
```

From here we need to use **pusher** api for sockets.
Need to create **Pusher Account**

----------------------------------------------------------------------------------------------------------------------------------------

# Server side configuration

**Pusher Composer** package to install:
```
    composer require pusher/pusher-php-server "~3.0"
```

Then configure in *.env*:
``` 
    APP_ID
    APP_SECRET
    APP_KEY
    APP_CLUSTER
```

Next step should be web-sockets configuration.

In project directory *config/websockets.php*
```
    'apps' => [
            [
                'id' => env('PUSHER_APP_ID'),
                'name' => env('APP_NAME'),
                'key' => env('PUSHER_APP_KEY'),
                'secret' => env('PUSHER_APP_SECRET'),
                'path' => env('PUSHER_APP_PATH'),
                'capacity' => null,
                'enable_client_messages' => false,
                'enable_statistics' => true,
            ],
        ],
```

And then in project directory *config/broadcasting.php* 


```
    'pusher' => [
        'driver' => 'pusher',
        'key' => env('PUSHER_APP_KEY'),
        'secret' => env('PUSHER_APP_SECRET'),
        'app_id' => env('PUSHER_APP_ID'),
        'options' => [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            // 'encrypted' => true,
            'host' => '127.0.0.1',
            'port' => 6001,
            'scheme' => 'http',
        ],
    ],
```
*Note* : If website is added with **SSL** then enable the *'encrypted' => true,*

Then create an new **event** for message sending in laravel.
```
    php artisan make:event NewMessage
```

The event class should implements the *ShouldBroadcast*
```
    use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

    class NewMessage implements ShouldBroadcast
```
----------------------------------------------------------------------------------------------------------------------------------------


# Client side configuration
Once the configurations are done at next step install **npm**
```
    npm install
```

At next step install *laravel echo* for client side
```
    npm install laravel-echo pusher-js
```

And then in project directory *resources/js/bootstrap.js* 

Enable the commented out code.

```
    import Echo from 'laravel-echo';

    window.Pusher = require('pusher-js');

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        wsHost: window.location.hostname,
        wsPort: 6001,
        forceTLS: false,
        disableStats: true,
    });
```

In *view* file

```
    <script src="{{ asset('js/app.js') }}"></script>

     <script>
        Echo.channel( {{channel-name}} )
            .listen( {{event-name}}, (e) => {
                console.log(e.data);
            })                        
    </script>
```

----------------------------------------------------------------------------------------------------------------------------------------

Serve the code.
```
    php artisan serve
```

Serve the websocket.
```
    php artisan websockets:serve
```

----------------------------------------------------------------------------------------------------------------------------------------

Run the **Websocket dashboard** through
```
    http://localhost:8000/laravel-websockets
```




