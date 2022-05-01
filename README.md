# Spatie-DB-Backup

## laravel-backup

Composer *package*
```
    composer require spatie/laravel-backup
```


Publish
```
    php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
```

Command to get back up
```
    php artisan backup:run
```

To clean up backups
```
    php artisan backup:clean
```

*Note* : These commands can either manually or by schedule time.

The backup clean are done by strategy

It can be seent at *config/backup.php*

Backups storing location can be defined by

*backup.php* inside this *key* => *destination* inside this *key* => *disks*

These backups notifications can be received through *mail, slack*

This can be set inside *config/backup.php*

*key* => *notifications*

```
    'mail' => [
                'to' => 'arundb@mailinator.com',

                'from' => [
                    'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
                    'name' => env('MAIL_FROM_NAME', 'Example'),
                ],
            ],
```

--------------------------------------------------------------------------------------------------------------

## Drive Storage

Backup the datas to the google drive.

Install package *composer*
```
    $ composer require nao-pon/flysystem-google-drive:~1.1
```

Create a service provider for GoogleDrive
```
    $ php artisan make:provider GoogleDriveServiceProvider
```

Inside *GoogleDriveServiceProvider* boot() method
```
        \Storage::extend('google', function ($app, $config) {
        $client = new \Google_Client();
        $client->setClientId($config['clientId']);
        $client->setClientSecret($config['clientSecret']);
        $client->refreshToken($config['refreshToken']);
        $service = new \Google_Service_Drive($client);
        $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, $config['folderId']);
        return new \League\Flysystem\Filesystem($adapter);
    });     
```

Add disk in *config/filesystems.php*
```
    return [
    
        // ...
        
        'disks' => [
            
            // ...
            
            'google' => [
                'driver' => 'google',
                'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
                'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
                'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
                'folderId' => env('GOOGLE_DRIVE_FOLDER_ID'),
            ],
            
            // ...
            
        ],
        
        // ...
    ];
```

Create google Credentials
```
    GOOGLE_DRIVE_CLIENT_ID=xxx.apps.googleusercontent.com
    GOOGLE_DRIVE_CLIENT_SECRET=xxx
    GOOGLE_DRIVE_REFRESH_TOKEN=xxx
    GOOGLE_DRIVE_FOLDER_ID=null
```

In *config/backup.php*
```
    'backup' => [

        /*
         * The name of this application. You can use this name to monitor
         * the backups.
         */
        'name' => '*id for google drive folder*',
    ],
```

--------------------------------------------------------------------------------------------------------------

