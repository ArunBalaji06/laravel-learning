# laravel-learning

## Octane
Install octane through
```
    composer require laravel/octane

    php artisan octane:install
```
This octane can run through either ***roadrunner*** or ***swoole***
To install roadrunner

-> Simply follow the steps while installing octane

This Octane is used to increase the performance of the project.

Octane runs in laravel 8 and php 8

## Start

To start octane
```
    php artisan octane:start
```
This one cannot detect the changes made in file only when octane restarted can detect the changes.

To detect the changes automatically run
```
    php artisan octane:start --watch
```

To work ***--watch*** to work our machine need to install ***npm***
To install npm:
```
    npm install
```

## Watch

This watch method in configured in ***config/octane.php*** file:
In the watch array we say which are all the files that can be watched while changes made

EG:
```
    'watch' => [
            'app',
            'bootstrap',
            'config',
            'database',
            'public/**/*.php',
            'resources/**/*.php',
            'routes',
            'composer.lock',
            '.env',
        ],
```

## Reload

To make the changed codes to detect we can manually use:
```
    php artisan octane:reload
```
This command reloads the octane server to load the newly changed code in octane server.

## Stop

To stop the Octane server
```
    php artisan octane:stop
```

## Status

To check whether the octane is running or not
```
    php artisan octane:status
```

The performance of the application is shown below
![Performance](/public/images/octane_performance.png)

Above image shows the time difference between first request and other requests.
