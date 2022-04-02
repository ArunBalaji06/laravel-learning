# laravel-learning


## Gates

Laravel gates can be used in blade file for simple authorization.

Define gate in **AuthServiceProvider** inside of **Providers** directory.

**Example**
    ```
    Gate::define('isAdmin', function($user) {
           return $user->role == 'admin';
        });
    ```

After defining gate in **AuthServiceProvider** you can use gates in Blade file.

**Example**
    ```
    @can('isAdmin')
        //....do something
    @endcan
    ```

## Policies

Laravel policies can be used for model events and for all records.

Register policy in **AuthServiceProvider** inside of **Providers** directory.

**Example**
    ```
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];
    ```

After registering policy in **AuthServiceProvider** you can use do your logic in **Controller**.

**Example**
    ```
    if ($user->can('create', Post::class)) {
            //...do something
        }
    ```


