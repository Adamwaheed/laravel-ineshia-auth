<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::find(1);
        $role = \App\Models\Role::find(1);
        $newUserRole = new \App\Models\UserRole();
        $newUserRole->user_id = $user->id;
        $newUserRole->role_id = $role->id;
        $newUserRole->save();

    }
}
