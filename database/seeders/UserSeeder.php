<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@pizza.hu',
                'password' => bcrypt('admin123'),
                'role_id' => 3,
            ],
            [
                'name' => 'Kiss Béla',
                'email' => 'bela@pizza.hu',
                'password' => bcrypt('user123'),
                'role_id' => 2,
            ],
            [
                'name' => 'Nagy Éva',
                'email' => 'eva@pizza.hu',
                'password' => bcrypt('user123'),
                'role_id' => 2,
            ],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(['email' => $u['email']], $u);
        }

        echo "✅ UserSeeder: 3 felhasználó létrehozva.\n";
    }
}
