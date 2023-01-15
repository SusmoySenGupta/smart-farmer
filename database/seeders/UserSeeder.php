<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'mobile_no' => '1734567892',
        ])->assignRole('admin');

        User::create([
            'name' => 'Farmer',
            'email' => 'farmer@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'mobile_no' => '1834567893',
        ])->assignRole('farmer');

        User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'mobile_no' => '1934567894',
        ])->assignRole('customer');

        $roles = ['farmer', 'customer'];
        User::factory(97)->create()->each(fn($user) => $user->assignRole(Arr::random($roles)));
    }
}
