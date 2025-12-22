<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@sofoodtchad.local'],
            [
                'name' => 'Sofood Admin',
                'password' => Hash::make('password'),
            ]
        );

        $role = Role::where('name', 'admin')->first();
        if ($role) {
            $user->roles()->syncWithoutDetaching([$role->id]);
        }
    }
}
