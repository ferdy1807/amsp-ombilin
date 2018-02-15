<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_user = [
            'name'     => 'Super Admin',
            'email'    => 'superadmin@mail.com',
            'password' => Hash::make('admin2018'),
            'level'    => User::SUPERADMIN,
        ];
        User::create($new_user);

        $new_user = [
            'name'     => 'Admin',
            'email'    => 'admin@mail.com',
            'password' => Hash::make('admin2018'),
            'level'    => User::ADMIN,
        ];
        User::create($new_user);

        $new_user = [
            'name'     => 'User',
            'email'    => 'user@mail.com',
            'password' => Hash::make('admin2018'),
            'level'    => User::USER,
        ];
        User::create($new_user);
    }
}
