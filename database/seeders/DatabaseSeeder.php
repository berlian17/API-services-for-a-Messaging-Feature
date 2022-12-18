<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Berlian Akbar Rusmana',
                'email' => 'admin1@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lidya Rusmana Putri',
                'email' => 'admin2@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Septian Pratama Rusmana',
                'email' => 'admin3@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
