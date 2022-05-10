# laravel-learning
## Passport

Composer **install**
```
    composer require laravel/passport

    php artisan migrate

    php artisan passport:install
```

If we use **uuids** instead of auto-increament **id**
```
    php artisan passport:install --uuids
```

To create access tokens
```
    $token['token'] =  $user->createToken('LearningToken')->accessToken;
```

***NOTE*** : **$user** will the created users instance.

Tokens for users will be stored in **oauth_access_tokens** table.
Tokens for client will be stored in **oauth_clients** table.

In laravel passport tokens time period can be customized manually:

**App\Providers\AuthServiceProvider** directory
```
    public function boot()
    {
        $this->registerPolicies();
    
        Passport::routes();
    
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
```

For passport middleware:

Laravel Passport middleware will be default,
```
    Route::get('/user', function () {
        //
    })->middleware('auth:api');
```


## Interface

Also in this branch ***Interface***

```
<!-- Interface -->
    <?php
    namespace App\Interfaces;

    interface ResponseInterface
    {
        function sendResponses($message,$data,$status);
    }
```

```
<!-- Interface implemented class -->
    <?php

    namespace App\Interfaces;

    use App\Interfaces\ResponseInterface;
    use App\Http\Controllers\Controller;

    class SendResponse extends Controller implements ResponseInterface {

        public function sendResponses($message,$data,$status){
            return response()->json([
                'message' => $message,
                'body' => $data,
                'status' => $status
            ]);
        }
    }
```

```
<!-- Controller -->
class UserController extends SendResponse
```


