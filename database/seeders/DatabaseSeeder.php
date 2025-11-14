<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        foreach (RoleEnum::cases() as $role) {
            Role::updateOrCreate(
                ['name' => $role->value],
                ['guard_name' => 'web']
            );
        }

        $users = [
            ['name' => 'Admin',   'email' => 'admin@gmail.com',   'role' => RoleEnum::ADMIN],
            ['name' => 'Member',  'email' => 'member@gmail.com',  'role' => RoleEnum::MEMBER],
            ['name' => 'Creator', 'email' => 'creator@gmail.com', 'role' => RoleEnum::CREATOR],
        ];

        foreach ($users as $data) {
            $user = User::factory()->create([
                'name'  => $data['name'],
                'email' => $data['email'],
            ]);

            $user->syncRoles($data['role']->value);
        }

        // User::factory(40)->create();
    }
}
