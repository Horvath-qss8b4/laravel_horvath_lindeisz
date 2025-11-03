<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'guest'],
            ['id' => 2, 'name' => 'user'],
            ['id' => 3, 'name' => 'admin'],
        ];

        foreach ($roles as $r) {
            Role::updateOrCreate(['id' => $r['id']], ['name' => $r['name']]);
        }

        echo "✅ RoleSeeder: szerepkörök feltöltve.\n";
    }
}
