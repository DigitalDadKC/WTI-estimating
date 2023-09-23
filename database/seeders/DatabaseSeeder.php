<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $user = User::factory()->create([
        //     'name' => 'Raleigh',
        //     'email' => 'raleighgroesbeck@gmail.com',
        //     'password' => bcrypt('KSUwildcat#5')
        // ]);

        $this->call(StateSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PricebookSeeder::class);
        $this->call(CooperativeSeeder::class);
        $this->call(GuidelineSeeder::class);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}