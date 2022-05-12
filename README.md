# laravel-learning

## Laravel Sanctum

Composer ***install***
```
    composer require laravel/sanctum

    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

    php artisan migrate
```

After this enable the middleware in  ***App\Http\Kernel.php***
```
    'api' => [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        'throttle:api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
```

User Model **HasApiTokens**
```
    use Laravel\Sanctum\HasApiTokens;
 
    class User extends Authenticatable
    {
        use HasApiTokens, HasFactory, Notifiable;
    }
```

To create token in controller
```
    $token = $request->user()->createToken($request->token_name);


    <!-- To create token with name - pass token name as second param -->

    $token = $users->createToken('user-token',['user']);

    
    <!-- To create token with name with many abilities pass as array in second param -->

    $token = $users->createToken('super-token',['user','admin']);
```

## Middlewares

Give default middlewares in ***app/Http/Kernel.php***

```
    'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
    'ability' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
```

To check **Either** ability
If any one ability presents - middleware will get pass.
```
    Route::get('/orders', function () {
        // Token has the "check-status" or "place-orders" ability...
    })->middleware(['auth:sanctum', 'ability:check-status,place-orders']);
```

To check **Both Abilities** are present
If any one ability is not present - middleware will get fail.
```
    Route::get('/orders', function () {
        // Token has both "check-status" and "place-orders" abilities...
    })->middleware(['auth:sanctum', 'abilities:check-status,place-orders']);
```

To delete all tokens
```
    $user->tokens()->delete();
```
 
To delete specific token
``` 
    $user->tokens()->where('id', $tokenId)->delete();
```

To delete the currently using token
```
    $request->user()->currentAccessToken()->delete();
```