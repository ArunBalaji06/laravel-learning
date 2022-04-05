# laravel-learning

----------------------------------------------------------------------------------------------------------------------------

# Roles and Permissions Version 5.5

## Authentication

This branch contains **Laravel-Breeze** authentication.

Install laravel by **composer command** given below:

```
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run dev
php artisan migrate
```

## Roles and Permissions

Roles and permissions can be used for users who have *different roles*, and different roles contains *different permissions*.
Install **spatie** package for roles and permisssions.

```
composer require spatie/laravel-permission
```

To **check** package version use below line in terminal:

```
composer show spatie/laravel-permission
```

In *config/app.php* add:

```
Spatie\Permission\PermissionServiceProvider::class,
```

Then **publish** the package with command:

```
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

At last **migrate** the tables.

```
php artisan migrate
```
----------------------------------------------------------------------------------------------------------------------------

# Middleware

Middlewares available in this package is given below:

```
'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
```

----------------------------------------------------------------------------------------------------------------------------

# Permissions

Permissions can be given in middleware which already ready to use in the **spatie package**.

Permission can be given in **route** or **controller**.

## Controller Middleware.

Permission given in controller example given below:

```
$this->middleware('permission:post.update|post.view|post.delete',['only' => ['update','view','delete']]);
```

----------------------------------------------------------------------------------------------------------------------------

# Roles

Roles are created for users and admin, multiple roles can be given.

### Example

```
User::create([
            ...do something,
        ])->assignRole('admin')->givePermissionTo('toUpdate');
```

Roles can also be used in blade file by blade attribute.

### Example

```
@role('admin')
  ...do something
@endrole
```

----------------------------------------------------------------------------------------------------------------------------






