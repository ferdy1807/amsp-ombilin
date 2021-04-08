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
            'image'    => 'default.png'
        ];
        User::create($new_user);

        $new_user = [
            'name'     => 'Admin',
            'email'    => 'admin@mail.com',
            'password' => Hash::make('admin2018'),
            'level'    => User::ADMIN,
            'image'    => 'default.png'
        ];
        User::create($new_user);

        $new_user = [
            'name'     => 'User',
            'email'    => 'user@mail.com',
            'password' => Hash::make('admin2018'),
            'level'    => User::USER,
            'image'    => 'default.png'
        ];
        User::create($new_user);

        $new_user = [
          'name' =>'yuda',
          'email' =>'yuda@gmail.com',
          'password' => Hash::make('admin2018'),
          'level'    => User::USER,
        ];
          User::create($new_user);
    }
}
