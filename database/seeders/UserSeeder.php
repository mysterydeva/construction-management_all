<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Construction Business Users
        User::create([
            'name' => 'John Constructor',
            'email' => 'admin@construction.local',
            'password' => Hash::make('password'),
            'business_id' => 1,
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Sarah Project Manager',
            'email' => 'manager@construction.local',
            'password' => Hash::make('password'),
            'business_id' => 1,
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'Mike Accountant',
            'email' => 'accountant@construction.local',
            'password' => Hash::make('password'),
            'business_id' => 1,
            'role' => 'accountant',
        ]);

        // UPVC Business Users
        User::create([
            'name' => 'Alex UPVC Admin',
            'email' => 'admin@upvc.local',
            'password' => Hash::make('password'),
            'business_id' => 2,
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Lisa Sales Rep',
            'email' => 'sales@upvc.local',
            'password' => Hash::make('password'),
            'business_id' => 2,
            'role' => 'sales',
        ]);

        User::create([
            'name' => 'Tom UPVC Manager',
            'email' => 'manager@upvc.local',
            'password' => Hash::make('password'),
            'business_id' => 2,
            'role' => 'manager',
        ]);

        // Interior Business Users
        User::create([
            'name' => 'Emma Interior Admin',
            'email' => 'admin@interior.local',
            'password' => Hash::make('password'),
            'business_id' => 3,
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'David Interior Designer',
            'email' => 'designer@interior.local',
            'password' => Hash::make('password'),
            'business_id' => 3,
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'Sophie Interior Sales',
            'email' => 'sales@interior.local',
            'password' => Hash::make('password'),
            'business_id' => 3,
            'role' => 'sales',
        ]);
    }
}
