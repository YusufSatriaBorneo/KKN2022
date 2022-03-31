<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Kel.Jabungan',
                'email' => 'kelurahan@jabungan.com',
                'password' => Hash::make('jabungan2021'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
