<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            "name"=> "Saugat Gurung",
            "email" => "fangurung90@gmail.com",
            "password" => Hash::make("password"),
            "date_of_birth" => "1989-09-10"
         ]);

        // UserFactory::new()->count(10)->create();
    }
}
