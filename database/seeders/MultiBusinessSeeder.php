<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MultiBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('projects')->delete();
        DB::table('inventory')->delete();
        DB::table('leads')->delete();
        DB::table('quotations')->delete();
        DB::table('invoices')->delete();
        DB::table('expenses')->delete();

        // Seed Construction Business Data
        $this->seedConstructionData();

        // Seed Sales Business Data
        $this->seedSalesData();

        // Seed Design Business Data
        $this->seedDesignData();
    }

    /**
     * Seed construction business data.
     */
    private function seedConstructionData(): void
    {
        // Construction Projects
        DB::table('projects')->insert([
            [
                'id' => Str::uuid(),
                'business_type' => 'construction',
                'name' => 'Office Complex Construction',
                'client' => 'ABC Corporation',
                'type' => 'Commercial',
                'status' => 'Active',
                'start_date' => '2024-01-15',
                'end_date' => '2024-06-30',
                'budget' => 2500000,
                'description' => 'Multi-story office complex construction',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'business_type' => 'construction',
                'name' => 'Residential Building',
                'client' => 'XYZ Developers',
                'type' => 'Residential',
                'status' => 'Active',
                'start_date' => '2024-02-01',
                'end_date' => '2024-12-31',
                'budget' => 1800000,
                'description' => 'Apartment complex construction',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Construction Inventory
        DB::table('inventory')->insert([
            [
                'id' => Str::uuid(),
                'business_type' => 'construction',
                'name' => 'Cement Bags',
                'category' => 'Building Materials',
                'quantity' => 500,
                'unit_price' => 350,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'business_type' => 'construction',
                'name' => 'Steel Rods',
                'category' => 'Building Materials',
                'quantity' => 2000,
                'unit_price' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Construction Expenses
        DB::table('expenses')->insert([
            [
                'id' => Str::uuid(),
                'business_type' => 'construction',
                'date' => '2024-02-20',
                'description' => 'Cement Purchase - 100 bags',
                'category' => 'Materials',
                'amount' => 35000,
                'payment_method' => 'Bank Transfer',
                'status' => 'Paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'business_type' => 'construction',
                'date' => '2024-02-18',
                'description' => 'Steel Rods - 2 tons',
                'category' => 'Materials',
                'amount' => 120000,
                'payment_method' => 'Cheque',
                'status' => 'Paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Seed sales business data.
     */
    private function seedSalesData(): void
    {
        // Sales Leads
        DB::table('leads')->insert([
            [
                'id' => Str::uuid(),
                'business_type' => 'sales',
                'name' => 'Rahul Sharma',
                'email' => 'rahul.sharma@example.com',
                'phone' => '+91 9876543210',
                'company' => 'UPVC Solutions Ltd',
                'source' => 'Website',
                'status' => 'Qualified',
                'budget' => 45000,
                'description' => 'Interested in UPVC windows for office',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'business_type' => 'sales',
                'name' => 'Priya Patel',
                'email' => 'priya.patel@example.com',
                'phone' => '+91 9876543211',
                'company' => 'Home Interiors',
                'source' => 'Referral',
                'status' => 'Contacted',
                'budget' => 38500,
                'description' => 'Looking for UPVC doors',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Sales Quotations
        DB::table('quotations')->insert([
            [
                'id' => Str::uuid(),
                'business_type' => 'sales',
                'quote_number' => 'Q-2024-001',
                'client_name' => 'Rahul Sharma',
                'project_name' => 'Office Windows',
                'amount' => 45000,
                'gst' => 8100,
                'total' => 53100,
                'status' => 'Paid',
                'due_date' => '2024-03-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'business_type' => 'sales',
                'quote_number' => 'Q-2024-002',
                'client_name' => 'Priya Patel',
                'project_name' => 'Home Doors',
                'amount' => 38500,
                'gst' => 6930,
                'total' => 45430,
                'status' => 'Pending',
                'due_date' => '2024-03-08',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Seed design business data.
     */
    private function seedDesignData(): void
    {
        // Design Projects
        DB::table('projects')->insert([
            [
                'id' => Str::uuid(),
                'business_type' => 'design',
                'name' => 'Living Room Makeover',
                'client' => 'Priya Sharma',
                'type' => 'Living Room',
                'status' => 'Completed',
                'start_date' => '2024-01-10',
                'end_date' => '2024-02-15',
                'budget' => 150000,
                'description' => 'Complete living room redesign',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'business_type' => 'design',
                'name' => 'Master Bedroom Design',
                'client' => 'Rahul Verma',
                'type' => 'Bedroom',
                'status' => 'Completed',
                'start_date' => '2024-01-20',
                'end_date' => '2024-03-01',
                'budget' => 200000,
                'description' => 'Luxury bedroom design',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Design Expenses
        DB::table('expenses')->insert([
            [
                'id' => Str::uuid(),
                'business_type' => 'design',
                'date' => '2024-02-20',
                'description' => 'Fabric Purchase - Sofa Set',
                'category' => 'Materials',
                'amount' => 25000,
                'payment_method' => 'Bank Transfer',
                'status' => 'Paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'business_type' => 'design',
                'date' => '2024-02-18',
                'description' => 'Paint Supplies - Premium Colors',
                'category' => 'Materials',
                'amount' => 15000,
                'payment_method' => 'Cash',
                'status' => 'Paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
