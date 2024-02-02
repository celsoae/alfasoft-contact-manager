<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Faker\Factory as Faker;


class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
