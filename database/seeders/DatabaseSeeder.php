<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contact;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@alfasoft.com'
        ],
            [
                'password' => Hash::make("pass123@!"),
                'name' => "alfasoft",
            ]);


//        seed for fake contacts
        $faker = Faker::create();

        foreach (range(20, 40) as $contacts) {
            Contact::create([
                'name' => $faker->name,
                'contact' => '555' . rand(111111, 999999),
                'email' => $faker->unique()->safeEmail
            ]);
        }
    }
}
