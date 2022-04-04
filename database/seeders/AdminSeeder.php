<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'adminrole@mailinator.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('admin');

        $admin = User::find(1);
        $permissions = [
            'user.create',
            'user.view',
            'user.delete'
        ];

        foreach($permissions as $permission){
            $admin->givePermissionTo($permission);
        }
    }
}
