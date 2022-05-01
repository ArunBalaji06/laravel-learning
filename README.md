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

*Reference* => [https://medium.com/@dennissmink/laravel-backup-database-to-your-google-drive-f4728a2b74bd#id_token=eyJhbGciOiJSUzI1NiIsImtpZCI6Ijg2MTY0OWU0NTAzMTUzODNmNmI5ZDUxMGI3Y2Q0ZTkyMjZjM2NkODgiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmdvb2dsZS5jb20iLCJuYmYiOjE2NTEzNzYxMjUsImF1ZCI6IjIxNjI5NjAzNTgzNC1rMWs2cWUwNjBzMnRwMmEyamFtNGxqZGNtczAwc3R0Zy5hcHBzLmdvb2dsZXVzZXJjb250ZW50LmNvbSIsInN1YiI6IjExMDUwODMyMzY4MzY3NzA2MDEyNSIsImVtYWlsIjoiYXJ1bmJhbGFqaXNlbHZhbkBnbWFpbC5jb20iLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiYXpwIjoiMjE2Mjk2MDM1ODM0LWsxazZxZTA2MHMydHAyYTJqYW00bGpkY21zMDBzdHRnLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwibmFtZSI6ImFydW4gYmFsYWppIiwicGljdHVyZSI6Imh0dHBzOi8vbGgzLmdvb2dsZXVzZXJjb250ZW50LmNvbS9hL0FBVFhBSndLTkMxZHRqTEhJaEdSRVRrTGgxMHZHRktIWFlmXzZiLW9SWkU1PXM5Ni1jIiwiZ2l2ZW5fbmFtZSI6ImFydW4iLCJmYW1pbHlfbmFtZSI6ImJhbGFqaSIsImlhdCI6MTY1MTM3NjQyNSwiZXhwIjoxNjUxMzgwMDI1LCJqdGkiOiI0ZjY5MjUzM2NhZTBlZDJhY2YzNzlhYjY4YjA0YThmNzA3Nzc0YmM3In0.YD4epikBGhkoVVsypgn7k2qG1Hqgw511l2jlllQOvGz1eyaGcEXI96mRoDLH6G9AH6eDR-m9-HxjbGfTZlMS1MifEPpmq-iUmkRT6djYGnjuRuXfMaRIGcWcvVhoN3AwSDcvFlGTy30IL88oeLij5EpKHlLpubDeCV2gc-6Khltv36tZge1kOODAK9f5W-XQ6U4_GPG9rhd4oBeI0lRMNSMeKCGrcrEvy9Qz4QTgDKYEn-POYFwKgcOnZPeuX87d0fJ2a8SM61oypXtK7JTuq_m6QXhesEJk-0J9k-duHKWcHwcJVDKlB1tbHCrkWrRd2xNmAUeHccPgk9xDYAsG1Q]
