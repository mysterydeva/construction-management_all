# Multi-Business ERP System

A comprehensive Laravel 11 demo showcasing a multi-business ERP system with subdomain-based business separation.

## 🏢 Business Types

- **Construction** (`construction.localhost`) - Project management, inventory tracking
- **UPVC Windows & Doors** (`upvc.localhost`) - Lead management, quotations, sales
- **Interior Design** (`interior.localhost`) - Project management, billing

## 🚀 Features

### Core Functionality
- **Subdomain-based Business Isolation**: Each business operates on its own subdomain
- **Role-based Authentication**: Admin, Manager, Accountant, Sales roles
- **Business Context Injection**: Automatic business detection via middleware
- **Data Isolation**: All tables include `business_id` for complete separation

### Modules
- **Projects** (Construction & Interior): Client projects with cost tracking
- **Inventory** (Construction): Material management with valuation
- **Leads** (UPVC): Customer lead tracking and conversion
- **Quotations** (UPVC): Price quotations for clients
- **Invoices** (All): GST calculation, PDF generation, payment tracking
- **Expenses** (All): Business expense categorization

### Dashboard Analytics
- **Construction**: Project count, inventory value, expenses, profit calculation
- **UPVC**: Lead conversion rates, quotations, total sales
- **Interior**: Active projects, revenue tracking, margin analysis

### Technical Features
- **Bootstrap 5**: Modern, responsive UI
- **Chart.js**: Interactive dashboard charts
- **PDF Generation**: Invoice PDF downloads
- **Real-time GST Calculation**: JavaScript-powered tax calculations

## 📋 Demo Credentials

### Construction Business
- **URL**: `http://construction.localhost`
- **Admin**: `admin@construction.local` / `password`
- **Manager**: `manager@construction.local` / `password`
- **Accountant**: `accountant@construction.local` / `password`

### UPVC Business
- **URL**: `http://upvc.localhost`
- **Admin**: `admin@upvc.local` / `password`
- **Sales**: `sales@upvc.local` / `password`
- **Manager**: `manager@upvc.local` / `password`

### Interior Business
- **URL**: `http://interior.localhost`
- **Admin**: `admin@interior.local` / `password`
- **Designer**: `designer@interior.local` / `password`
- **Sales**: `sales@interior.local` / `password`

## 🛠️ Installation

### Prerequisites
- PHP 8.2+
- Composer
- Web server (Apache/Nginx)
- Database (MySQL/PostgreSQL/SQLite)

### Setup Steps

1. **Clone and Install**
   ```bash
   git clone <repository-url>
   cd multi-business-erp
   composer install
   ```

2. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Setup**
   
   **Option A: MySQL**
   ```bash
   # Update .env with your MySQL credentials
   DB_CONNECTION=mysql
   DB_DATABASE=erp_demo
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```
   
   **Option B: SQLite**
   ```bash
   # Update .env for SQLite
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   touch database/database.sqlite
   ```

4. **Run Migrations and Seed Data**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Local Development Setup**
   
   Add these entries to your `/etc/hosts` file:
   ```
   127.0.0.1 construction.localhost
   127.0.0.1 upvc.localhost
   127.0.0.1 interior.localhost
   ```

6. **Start Development Server**
   ```bash
   php artisan serve
   ```

7. **Access the Application**
   
   - Main login: `http://localhost/login`
   - Construction: `http://construction.localhost`
   - UPVC: `http://upvc.localhost`
   - Interior: `http://interior.localhost`

## 🏗️ Architecture

### Directory Structure
```
app/
├── Http/
│   ├── Controllers/          # Resource controllers
│   └── Middleware/           # Subdomain & role middleware
├── Models/                   # Eloquent models with relationships
database/
├── migrations/              # Database schema
└── seeders/                 # Demo data seeding
resources/
└── views/                   # Blade templates
```

### Key Components

#### Middleware
- **SubdomainMiddleware**: Detects subdomain and injects business context
- **RoleMiddleware**: Handles role-based access control

#### Models
- **Business**: Central business entity
- **User**: Multi-tenant users with business association
- **Project/Inventory/Lead/Quotation/Invoice/Expense**: Business modules

#### Controllers
- Full CRUD operations with business scoping
- Automatic business context injection
- Role-based access validation

## 📊 Demo Data

The system comes pre-seeded with realistic demo data:

### Construction Business
- **3 Projects**: Commercial complex, residential villa, warehouse
- **5 Inventory Items**: Cement, steel, bricks, sand, paint
- **4 Expenses**: Labor, equipment, rent, transport

### UPVC Business
- **10 Leads**: Various sources and statuses
- **4 Quotations**: Different customer proposals
- **3 Invoices**: With GST calculations
- **2 Expenses**: Showroom rent, marketing

### Interior Business
- **2 Projects**: Office design, home renovation
- **3 Invoices**: Completed and pending payments
- **2 Expenses**: Software, materials

## 🎯 Business Logic

### Dashboard Calculations

**Construction:**
- Total Projects: Count of all projects
- Inventory Value: Σ(quantity × unit_price)
- Simple Profit: Σ(actual_cost) - Σ(expenses)

**UPVC:**
- Conversion Rate: (Converted Leads / Total Leads) × 100
- Total Sales: Σ(paid invoice amounts)

**Interior:**
- Margin %: ((Revenue - Expenses) / Revenue) × 100

### GST Calculation
- Automatic GST calculation based on subtotal and percentage
- Support for multiple GST rates (0%, 5%, 12%, 18%, 28%)
- Real-time calculation in invoice creation form

## 🔧 Customization

### Adding New Business Types
1. Create business in `BusinessSeeder`
2. Add users in `UserSeeder`
3. Customize dashboard logic in `DashboardController`
4. Update navigation in layout

### Extending Modules
1. Create migration with `business_id` field
2. Create model with business scoping
3. Implement controller with business validation
4. Add views with business context

## 📝 Notes

### Limitations (Demo Purpose)
- No double-entry accounting
- Simplified business logic
- No production optimizations
- Basic security implementation

### Production Considerations
- Enhanced security measures
- Performance optimizations
- Advanced business logic
- Audit logging
- API endpoints
- Multi-currency support

## 🤝 Contributing

This is a demo system showcasing Laravel capabilities for multi-business ERP solutions.

---

**Built with Laravel 11, Bootstrap 5, Chart.js, and DomPDF**
