<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Business::create([
            'name' => 'BuildRight Construction',
            'subdomain' => 'construction',
            'type' => 'construction',
        ]);

        Business::create([
            'name' => 'UPVC Windows & Doors',
            'subdomain' => 'upvc',
            'type' => 'upvc',
        ]);

        Business::create([
            'name' => 'Elegant Interior Designs',
            'subdomain' => 'interior',
            'type' => 'interior',
        ]);
    }
}
