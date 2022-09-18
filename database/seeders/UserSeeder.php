<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env("APP_ENV") === "local" || env("APP_ENV") === "testing") {
            $user = new User();
            $user->id = 1;
            $user->email = "localadmin@localhost.local";
            $user->email_verified_at = now();
            $user->password = Hash::make("localadmin123");
            $user->save();
        }

        User::factory(10)->create();
    }
}
