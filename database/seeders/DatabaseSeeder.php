<?php

namespace Database\Seeders;

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

        $roles = ['admin', 'member', 'creator'];

        foreach ($roles as $roleName) {
            Role::updateOrCreate(['name' => $roleName], ['guard_name' => 'web']);
        }

        $users = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'role' => 'admin'],
            ['name' => 'Member', 'email' => 'member@gmail.com', 'role' => 'member'],
            ['name' => 'Creator', 'email' => 'creator@gmail.com', 'role' => 'creator'],
        ];

        foreach ($users as $data) {
            $user = User::factory()->create([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
            $user->syncRoles($data['role']);
        }

        User::factory(40)->create();
    }
}
