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
        // \App\Models\User::factory(10)->create();

        \App\Models\Admin::create([
            'agent_id' => 'BCG202MSTR',
            'username' => 'mastersite',
            'email' => '4uklyzz@gmail.com',
            'password' => '$2y$10$hlB2zPHvu8qv08cbf/28SeMiwHu1./IWSw.ZUEwChdqY/juSd9pZu',
            'parent' => NULL,
            'balance' => 5000000,
            'ip_whitelist' => NULL,
            'pin' => NULL,
            'pin_status' => 0,
            'status' => 1,
        ]);
    }
}
