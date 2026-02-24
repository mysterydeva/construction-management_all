<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Inventory;
use App\Models\Lead;
use App\Models\Quotation;
use App\Models\Invoice;
use App\Models\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Construction Business Demo Data (Business ID: 1)
        
        // Projects for Construction
        Project::create([
            'business_id' => 1,
            'client_name' => 'Mahesh Kumar',
            'project_name' => 'Commercial Complex Building',
            'estimated_cost' => 2500000.00,
            'actual_cost' => 2750000.00,
            'status' => 'completed',
        ]);

        Project::create([
            'business_id' => 1,
            'client_name' => 'Priya Sharma',
            'project_name' => 'Residential Villa',
            'estimated_cost' => 1800000.00,
            'actual_cost' => 1650000.00,
            'status' => 'active',
        ]);

        Project::create([
            'business_id' => 1,
            'client_name' => 'Raj Enterprises',
            'project_name' => 'Warehouse Construction',
            'estimated_cost' => 3200000.00,
            'actual_cost' => null,
            'status' => 'planning',
        ]);

        // Inventory for Construction
        Inventory::create([
            'business_id' => 1,
            'item_name' => 'Cement Bags',
            'quantity' => 500,
            'unit' => 'bags',
            'unit_price' => 350.00,
        ]);

        Inventory::create([
            'business_id' => 1,
            'item_name' => 'Steel Rods',
            'quantity' => 2000,
            'unit' => 'kg',
            'unit_price' => 65.00,
        ]);

        Inventory::create([
            'business_id' => 1,
            'item_name' => 'Bricks',
            'quantity' => 10000,
            'unit' => 'pieces',
            'unit_price' => 8.50,
        ]);

        Inventory::create([
            'business_id' => 1,
            'item_name' => 'Sand',
            'quantity' => 50,
            'unit' => 'tons',
            'unit_price' => 1200.00,
        ]);

        Inventory::create([
            'business_id' => 1,
            'item_name' => 'Paint',
            'quantity' => 100,
            'unit' => 'liters',
            'unit_price' => 280.00,
        ]);

        // Expenses for Construction
        Expense::create([
            'business_id' => 1,
            'title' => 'Labor Wages - March',
            'amount' => 450000.00,
            'category' => 'labor',
        ]);

        Expense::create([
            'business_id' => 1,
            'title' => 'Equipment Rental',
            'amount' => 75000.00,
            'category' => 'equipment',
        ]);

        Expense::create([
            'business_id' => 1,
            'title' => 'Office Rent',
            'amount' => 25000.00,
            'category' => 'rent',
        ]);

        Expense::create([
            'business_id' => 1,
            'title' => 'Material Transport',
            'amount' => 35000.00,
            'category' => 'transport',
        ]);

        // UPVC Business Demo Data (Business ID: 2)
        
        // Leads for UPVC
        Lead::create([
            'business_id' => 2,
            'customer_name' => 'Amit Patel',
            'phone' => '+91 98765 43210',
            'source' => 'website',
            'status' => 'converted',
        ]);

        Lead::create([
            'business_id' => 2,
            'customer_name' => 'Neha Gupta',
            'phone' => '+91 87654 32109',
            'source' => 'referral',
            'status' => 'contacted',
        ]);

        Lead::create([
            'business_id' => 2,
            'customer_name' => 'Vikram Singh',
            'phone' => '+91 76543 21098',
            'source' => 'cold_call',
            'status' => 'qualified',
        ]);

        Lead::create([
            'business_id' => 2,
            'customer_name' => 'Anjali Desai',
            'phone' => '+91 65432 10987',
            'source' => 'website',
            'status' => 'new',
        ]);

        Lead::create([
            'business_id' => 2,
            'customer_name' => 'Rohit Verma',
            'phone' => '+91 54321 09876',
            'source' => 'referral',
            'status' => 'converted',
        ]);

        Lead::create([
            'business_id' => 2,
            'customer_name' => 'Kavita Reddy',
            'phone' => '+91 43210 98765',
            'source' => 'website',
            'status' => 'lost',
        ]);

        Lead::create([
            'business_id' => 2,
            'customer_name' => 'Manoj Kumar',
            'phone' => '+91 32109 87654',
            'source' => 'cold_call',
            'status' => 'contacted',
        ]);

        Lead::create([
            'business_id' => 2,
            'customer_name' => 'Pooja Mehta',
            'phone' => '+91 21098 76543',
            'source' => 'referral',
            'status' => 'qualified',
        ]);

        Lead::create([
            'business_id' => 2,
            'customer_name' => 'Sanjay Shah',
            'phone' => '+91 10987 65432',
            'source' => 'website',
            'status' => 'new',
        ]);

        Lead::create([
            'business_id' => 2,
            'customer_name' => 'Deepa Nair',
            'phone' => '+91 09876 54321',
            'source' => 'cold_call',
            'status' => 'converted',
        ]);

        // Quotations for UPVC
        Quotation::create([
            'business_id' => 2,
            'customer_name' => 'Amit Patel',
            'total_amount' => 85000.00,
            'status' => 'accepted',
        ]);

        Quotation::create([
            'business_id' => 2,
            'customer_name' => 'Neha Gupta',
            'total_amount' => 62000.00,
            'status' => 'sent',
        ]);

        Quotation::create([
            'business_id' => 2,
            'customer_name' => 'Vikram Singh',
            'total_amount' => 120000.00,
            'status' => 'draft',
        ]);

        Quotation::create([
            'business_id' => 2,
            'customer_name' => 'Rohit Verma',
            'total_amount' => 45000.00,
            'status' => 'accepted',
        ]);

        // Invoices for UPVC
        Invoice::create([
            'business_id' => 2,
            'invoice_number' => 'INV-0001',
            'client_name' => 'Amit Patel',
            'subtotal' => 85000.00,
            'gst_percentage' => 18.00,
            'gst_amount' => 15300.00,
            'total_amount' => 100300.00,
            'payment_status' => 'paid',
        ]);

        Invoice::create([
            'business_id' => 2,
            'invoice_number' => 'INV-0002',
            'client_name' => 'Rohit Verma',
            'subtotal' => 45000.00,
            'gst_percentage' => 18.00,
            'gst_amount' => 8100.00,
            'total_amount' => 53100.00,
            'payment_status' => 'paid',
        ]);

        Invoice::create([
            'business_id' => 2,
            'invoice_number' => 'INV-0003',
            'client_name' => 'Deepa Nair',
            'subtotal' => 72000.00,
            'gst_percentage' => 18.00,
            'gst_amount' => 12960.00,
            'total_amount' => 84960.00,
            'payment_status' => 'pending',
        ]);

        // Expenses for UPVC
        Expense::create([
            'business_id' => 2,
            'title' => 'Showroom Rent',
            'amount' => 30000.00,
            'category' => 'rent',
        ]);

        Expense::create([
            'business_id' => 2,
            'title' => 'Marketing Campaign',
            'amount' => 15000.00,
            'category' => 'marketing',
        ]);

        // Interior Business Demo Data (Business ID: 3)
        
        // Projects for Interior
        Project::create([
            'business_id' => 3,
            'client_name' => 'Sameer Agarwal',
            'project_name' => 'Office Interior Design',
            'estimated_cost' => 800000.00,
            'actual_cost' => 750000.00,
            'status' => 'completed',
        ]);

        Project::create([
            'business_id' => 3,
            'client_name' => 'Divya Malhotra',
            'project_name' => 'Home Renovation',
            'estimated_cost' => 450000.00,
            'actual_cost' => 480000.00,
            'status' => 'active',
        ]);

        // Invoices for Interior
        Invoice::create([
            'business_id' => 3,
            'invoice_number' => 'INV-0001',
            'client_name' => 'Sameer Agarwal',
            'subtotal' => 750000.00,
            'gst_percentage' => 18.00,
            'gst_amount' => 135000.00,
            'total_amount' => 885000.00,
            'payment_status' => 'paid',
        ]);

        Invoice::create([
            'business_id' => 3,
            'invoice_number' => 'INV-0002',
            'client_name' => 'Divya Malhotra',
            'subtotal' => 240000.00,
            'gst_percentage' => 18.00,
            'gst_amount' => 43200.00,
            'total_amount' => 283200.00,
            'payment_status' => 'paid',
        ]);

        Invoice::create([
            'business_id' => 3,
            'invoice_number' => 'INV-0003',
            'client_name' => 'Rahul Bansal',
            'subtotal' => 320000.00,
            'gst_percentage' => 18.00,
            'gst_amount' => 57600.00,
            'total_amount' => 377600.00,
            'payment_status' => 'pending',
        ]);

        // Expenses for Interior
        Expense::create([
            'business_id' => 3,
            'title' => 'Design Software License',
            'amount' => 12000.00,
            'category' => 'software',
        ]);

        Expense::create([
            'business_id' => 3,
            'title' => 'Material Samples',
            'amount' => 8500.00,
            'category' => 'materials',
        ]);
    }
}
