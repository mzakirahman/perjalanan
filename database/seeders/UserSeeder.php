<?php

namespace Database\Seeders;

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
        User::create([
            'id_user' => '1',
            'nama' => "Admin",
            'username' => "admin",
            'role' => "1",
            'password' => bcrypt(md5('admin'))
        ]);
    }
}
