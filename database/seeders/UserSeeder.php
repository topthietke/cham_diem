<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class UserSeeder extends Seeder
{

    public function run(): void
    {

        DB::table('users')->insert([
            'name'              => 'Super Admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('password'), // Đổi thành mật khẩu mong muốn
            'role'              => 'super_admin',
            'remember_token'    => null,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
    }
}



