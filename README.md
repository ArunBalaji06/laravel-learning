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
