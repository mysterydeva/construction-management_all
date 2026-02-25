<?php

namespace App\Data;

class DemoDataProvider
{
    // Construction Business Data
    public static function getConstructionProjects(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Office Complex Construction',
                'client' => 'ABC Corporation',
                'type' => 'Commercial',
                'status' => 'Active',
                'start_date' => '2024-01-15',
                'end_date' => '2024-06-30',
                'budget' => 2500000,
                'description' => 'Multi-story office complex construction',
            ],
            [
                'id' => 2,
                'name' => 'Residential Building',
                'client' => 'XYZ Developers',
                'type' => 'Residential',
                'status' => 'Active',
                'start_date' => '2024-02-01',
                'end_date' => '2024-12-31',
                'budget' => 1800000,
                'description' => 'Apartment complex construction',
            ],
            [
                'id' => 3,
                'name' => 'Warehouse Construction',
                'client' => 'Logistics Ltd',
                'type' => 'Industrial',
                'status' => 'Planning',
                'start_date' => '2024-03-01',
                'end_date' => '2024-08-31',
                'budget' => 1200000,
                'description' => 'Warehouse construction',
            ],
        ];
    }

    public static function getConstructionInventory(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Cement Bags',
                'category' => 'Building Materials',
                'quantity' => 500,
                'unit_price' => 350,
                'total_value' => 175000,
            ],
            [
                'id' => 2,
                'name' => 'Steel Rods',
                'category' => 'Building Materials',
                'quantity' => 2000,
                'unit_price' => 60,
                'total_value' => 120000,
            ],
            [
                'id' => 3,
                'name' => 'Bricks',
                'category' => 'Building Materials',
                'quantity' => 10000,
                'unit_price' => 8,
                'total_value' => 80000,
            ],
            [
                'id' => 4,
                'name' => 'Paint',
                'category' => 'Finishing Materials',
                'quantity' => 100,
                'unit_price' => 45,
                'total_value' => 4500,
            ],
            [
                'id' => 5,
                'name' => 'PVC Pipes',
                'category' => 'Plumbing Materials',
                'quantity' => 500,
                'unit_price' => 25,
                'total_value' => 12500,
            ],
        ];
    }

    public static function getConstructionExpenses(): array
    {
        return [
            [
                'id' => 1,
                'date' => '2024-02-20',
                'description' => 'Cement Purchase - 100 bags',
                'category' => 'Materials',
                'amount' => 35000,
                'payment_method' => 'Bank Transfer',
                'status' => 'Paid',
            ],
            [
                'id' => 2,
                'date' => '2024-02-18',
                'description' => 'Steel Rods - 2 tons',
                'category' => 'Materials',
                'amount' => 120000,
                'payment_method' => 'Cheque',
                'status' => 'Paid',
            ],
            [
                'id' => 3,
                'date' => '2024-02-15',
                'description' => 'Labor Wages - Week 1',
                'category' => 'Labor',
                'amount' => 85000,
                'payment_method' => 'Cash',
                'status' => 'Paid',
            ],
            [
                'id' => 4,
                'date' => '2024-02-12',
                'description' => 'Equipment Rental - Crane',
                'category' => 'Equipment',
                'amount' => 25000,
                'payment_method' => 'Bank Transfer',
                'status' => 'Paid',
            ],
            [
                'id' => 5,
                'date' => '2024-02-10',
                'description' => 'Office Rent - February',
                'category' => 'Office',
                'amount' => 15000,
                'payment_method' => 'Cheque',
                'status' => 'Paid',
            ],
        ];
    }

    public static function getConstructionInvoices(): array
    {
        return [
            [
                'id' => 1,
                'invoice_number' => 'INV-2024-001',
                'client' => 'ABC Corporation',
                'project' => 'Office Complex Construction',
                'amount' => 450000,
                'gst' => 81000,
                'total' => 531000,
                'due_date' => '2024-03-15',
                'status' => 'Paid',
            ],
            [
                'id' => 2,
                'invoice_number' => 'INV-2024-002',
                'client' => 'XYZ Developers',
                'project' => 'Residential Building',
                'amount' => 320000,
                'gst' => 57600,
                'total' => 377600,
                'due_date' => '2024-03-10',
                'status' => 'Paid',
            ],
            [
                'id' => 3,
                'invoice_number' => 'INV-2024-003',
                'client' => 'Logistics Ltd',
                'project' => 'Warehouse Construction',
                'amount' => 280000,
                'gst' => 50400,
                'total' => 330400,
                'due_date' => '2024-03-05',
                'status' => 'Paid',
            ],
            [
                'id' => 4,
                'invoice_number' => 'INV-2024-004',
                'client' => 'Retail Mart',
                'project' => 'Retail Store Renovation',
                'amount' => 150000,
                'gst' => 27000,
                'total' => 177000,
                'due_date' => '2024-03-01',
                'status' => 'Pending',
            ],
            [
                'id' => 5,
                'invoice_number' => 'INV-2024-005',
                'client' => 'City Hospital',
                'project' => 'Hospital Extension',
                'amount' => 420000,
                'gst' => 75600,
                'total' => 495600,
                'due_date' => '2024-02-28',
                'status' => 'Pending',
            ],
        ];
    }

    // Sales Business Data
    public static function getSalesLeads(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Rahul Sharma',
                'email' => 'rahul.sharma@example.com',
                'phone' => '+91 9876543210',
                'company' => 'UPVC Solutions Ltd',
                'source' => 'Website',
                'status' => 'Qualified',
                'budget' => 45000,
                'description' => 'Interested in UPVC windows for office',
            ],
            [
                'id' => 2,
                'name' => 'Priya Patel',
                'email' => 'priya.patel@example.com',
                'phone' => '+91 9876543211',
                'company' => 'Home Interiors',
                'source' => 'Referral',
                'status' => 'Contacted',
                'budget' => 38500,
                'description' => 'Looking for UPVC doors',
            ],
            [
                'id' => 3,
                'name' => 'Amit Kumar',
                'email' => 'amit.kumar@example.com',
                'phone' => '+91 9876543212',
                'company' => 'Office Spaces Ltd',
                'source' => 'Cold Call',
                'status' => 'New',
                'budget' => 52000,
                'description' => 'Interested in UPVC windows',
            ],
            [
                'id' => 4,
                'name' => 'Neha Singh',
                'email' => 'neha.singh@example.com',
                'phone' => '+91 9876543213',
                'company' => 'Retail Store',
                'source' => 'Social Media',
                'status' => 'Qualified',
                'budget' => 25000,
                'description' => 'Looking for UPVC windows',
            ],
            [
                'id' => 5,
                'name' => 'Vikram Reddy',
                'email' => 'vikram.reddy@example.com',
                'phone' => '+91 987654214',
                'company' => 'Tech Solutions',
                'source' => 'Referral',
                'status' => 'Converted',
                'budget' => 65000,
                'description' => 'UPVC windows and doors',
            ],
            [
                'id' => 6,
                'name' => 'Anjali Gupta',
                'email' => 'anjali.gupta@example.com',
                'phone' => '+91 987654215',
                'company' => 'Interior Design Studio',
                'source' => 'Website',
                'status' => 'Contacted',
                'budget' => 38000,
                'description' => 'UPVC doors',
            ],
        ];
    }

    public static function getSalesQuotations(): array
    {
        return [
            [
                'id' => 1,
                'quote_number' => 'Q-2024-001',
                'client_name' => 'Rahul Sharma',
                'project_name' => 'Office Windows',
                'amount' => 45000,
                'gst' => 8100,
                'total' => 53100,
                'status' => 'Paid',
                'due_date' => '2024-03-10',
            ],
            [
                'id' => 2,
                'quote_number' => 'Q-2024-002',
                'client_name' => 'Priya Patel',
                'project_name' => 'Home Doors',
                'amount' => 38500,
                'gst' => 6930,
                'total' => 45430,
                'status' => 'Pending',
                'due_date' => '2024-03-08',
            ],
            [
                'id' => 3,
                'quote_number' => 'Q-2024-003',
                'client_name' => 'Amit Kumar',
                'project_name' => 'Shop Front',
                'amount' => 52000,
                'gst' => 9360,
                'total' => 61360,
                'status' => 'Pending',
                'due_date' => '2024-03-03',
            ],
            [
                'id' => 4,
                'quote_number' => 'Q-2024-004',
                'client_name' => 'Neha Singh',
                'project_name' => 'Bathroom Windows',
                'amount' => 28000,
                'gst' => 5040,
                'total' => 33040,
                'status' => 'Pending',
                'due_date' => '2024-03-03',
            ],
            [
                'id' => 5,
                'quote_number' => 'Q-2024-005',
                'client_name' => 'Vikram Reddy',
                'project_name' => 'Balcony Doors',
                'amount' => 65000,
                'gst' => 11700,
                'total' => 76700,
                'status' => 'Pending',
                'due_date' => '2024-03-03',
            ],
            [
                'id' => 6,
                'quote_number' => 'Q-2024-006',
                'client_name' => 'Anjali Gupta',
                'project_name' => 'Balcony Windows',
                'amount' => 42000,
                'gst' => 7560,
                'total' => 49560,
                'status' => 'Pending',
                'due_date' => '2024-03-03',
            ],
        ];
    }

    public static function getSalesInvoices(): array
    {
        return [
            [
                'id' => 1,
                'invoice_number' => 'INV-2024-001',
                'client' => 'Rahul Sharma',
                'project' => 'Office Windows',
                'amount' => 45000,
                'gst' => 8100,
                'total' => 53100,
                'due_date' => '2024-03-10',
                'status' => 'Paid',
            ],
            [
                'id' => 2,
                'invoice_number' => 'INV-2024-002',
                'client' => 'Priya Patel',
                'project' => 'Home Doors',
                'amount' => 38500,
                'gst' => 6930,
                'total' => 45430,
                'due_date' => '2024-03-08',
                'status' => 'Pending',
            ],
            [
                'id' => 3,
                'invoice_number' => 'INV-2024-003',
                'client' => 'Amit Kumar',
                'project' => 'Shop Front',
                'amount' => 52000,
                'gst' => 9360,
                'total' => 61360,
                'due_date' => '2024-03-03',
                'status' => 'Pending',
            ],
            [
                'id' => 4,
                'invoice_number' => 'INV-2024-004',
                'client' => 'Neha Singh',
                'project' => 'Bathroom Windows',
                'amount' => 28000,
                'gst' => 5040,
                'total' => 33040,
                'due_date' => '2024-03-03',
                'status' => 'Pending',
            ],
            [
                'id' => 5,
                'invoice_number' => 'INV-2024-005',
                'client' => 'Vikram Reddy',
                'project' => 'Balcony Doors',
                'amount' => 65000,
                'gst' => 11700,
                'total' => 76700,
                'due_date' => '2024-03-03',
                'status' => 'Pending',
            ],
            [
                'id' => 6,
                'invoice_number' => 'INV-2024-006',
                'client' => 'Anjali Gupta',
                'project' => 'Balcony Windows',
                'amount' => 42000,
                'gst' => 7560,
                'total' => 49560,
                'due_date' => '2024-03-03',
                'status' => 'Pending',
            ],
        ];
    }

    // Design Business Data
    public static function getDesignProjects(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Living Room Makeover',
                'client' => 'Priya Sharma',
                'type' => 'Living Room',
                'status' => 'Completed',
                'start_date' => '2024-01-10',
                'end_date' => '2024-02-15',
                'budget' => 150000,
                'description' => 'Complete living room redesign',
            ],
            [
                'id' => 2,
                'name' => 'Master Bedroom Design',
                'client' => 'Rahul Verma',
                'type' => 'Bedroom',
                'status' => 'Completed',
                'start_date' => '2024-01-20',
                'end_date' => '2024-03-01',
                'budget' => 200000,
                'description' => 'Luxury bedroom design',
            ],
            [
                'id' => 3,
                'name' => 'Kitchen Renovation',
                'client' => 'Anjali Patel',
                'type' => 'Kitchen',
                'status' => 'Active',
                'start_date' => '2024-02-01',
                'end_date' => '2024-04-15',
                'budget' => 300000,
                'description' => 'Complete kitchen renovation',
            ],
            [
                'id' => 4,
                'name' => 'Office Interior',
                'client' => 'Tech Solutions Ltd',
                'type' => 'Office',
                'status' => 'Active',
                'start_date' => '2024-02-15',
                'end_date' => '2024-05-01',
                'budget' => 200000,
                'description' => 'Office interior design',
            ],
        ];
    }

    public static function getDesignExpenses(): array
    {
        return [
            [
                'id' => 1,
                'date' => '2024-02-20',
                'description' => 'Fabric Purchase - Sofa Set',
                'category' => 'Materials',
                'amount' => 25000,
                'payment_method' => 'Bank Transfer',
                'status' => 'Paid',
            ],
            [
                'id' => 2,
                'date' => '2024-02-18',
                'description' => 'Paint Supplies - Premium Colors',
                'category' => 'Materials',
                'amount' => 15000,
                'payment_method' => 'Cash',
                'status' => 'Paid',
            ],
            [
                'id' => 3,
                'date' => '2024-02-15',
                'description' => 'Carpenter Wages - Week 2',
                'category' => 'Labor',
                'amount' => 12000,
                'payment_method' => 'Cash',
                'status' => 'Paid',
            ],
            [
                'id' => 4,
                'date' => '2024-02-12',
                'description' => 'Lighting Fixtures - Living Room',
                'category' => 'Equipment',
                'amount' => 8500,
                'payment_method' => 'Bank Transfer',
                'status' => 'Paid',
            ],
            [
                'id' => 5,
                'date' => '2024-02-10',
                'description' => 'Studio Rent - February',
                'category' => 'Office',
                'amount' => 10000,
                'payment_method' => 'Cheque',
                'status' => 'Paid',
            ],
            [
                'id' => 6,
                'date' => '2024-02-05',
                'description' => 'Decorative Items - Vases & Art',
                'category' => 'Materials',
                'amount' => 5000,
                'payment_method' => 'Credit Card',
                'status' => 'Pending',
            ],
        ];
    }

    public static function getDesignInvoices(): array
    {
        return [
            [
                'id' => 1,
                'invoice_number' => 'INV-2024-001',
                'client' => 'Priya Sharma',
                'project' => 'Living Room Makeover',
                'amount' => 135000,
                'gst' => 24300,
                'total' => 159300,
                'due_date' => '2024-02-20',
                'status' => 'Paid',
            ],
            [
                'id' => 2,
                'invoice_number' => 'INV-2024-002',
                'client' => 'Rahul Verma',
                'project' => 'Master Bedroom Design',
                'amount' => 180000,
                'gst' => 32400,
                'total' => 212400,
                'due_date' => '2024-03-01',
                'status' => 'Paid',
            ],
            [
                'id' => 3,
                'invoice_number' => 'INV-2024-003',
                'client' => 'Anjali Patel',
                'project' => 'Kitchen Renovation',
                'amount' => 270000,
                'gst' => 48600,
                'total' => 318600,
                'due_date' => '2024-04-20',
                'status' => 'Pending',
            ],
            [
                'id' => 4,
                'invoice_number' => 'INV-2024-004',
                'client' => 'Tech Solutions Ltd',
                'project' => 'Office Interior',
                'amount' => 180000,
                'gst' => 32400,
                'total' => 212400,
                'due_date' => '2024-05-01',
                'status' => 'Pending',
            ],
        ];
    }

    // Common data for all business types
    public static function getAllExpenses(): array
    {
        return array_merge(
            self::getConstructionExpenses(),
            self::getDesignExpenses()
        );
    }

    public static function getAllInvoices(): array
    {
        return array_merge(
            self::getConstructionInvoices(),
            self::getSalesInvoices(),
            self::getDesignInvoices()
        );
    }

    public static function getAllProjects(): array
    {
        return array_merge(
            self::getConstructionProjects(),
            self::getDesignProjects()
        );
    }
}
