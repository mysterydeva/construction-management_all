<?php

namespace App\Http\Controllers;

use App\Data\DemoDataProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UnifiedDashboardController extends Controller
{
    /**
     * Display the unified dashboard.
     */
    public function index(Request $request)
    {
        try {
            Log::info('Entered UnifiedDashboardController@index');
            
            // Check if session has business_type
            if (!session()->has('business_type')) {
                Log::warning('Session does not have business_type, setting default');
                session()->put('business_type', 'construction');
            }
            
            $businessType = session('business_type', 'construction');
            Log::info('Business type from session: ' . $businessType);
            
            // Check if request has business_type parameter
            if ($request->has('business_type')) {
                Log::info('Request has business_type parameter: ' . $request->get('business_type'));
            }
            
            // Get metrics based on business type
            $metrics = $this->getBusinessMetrics($businessType);
            Log::info('Metrics loaded successfully: ' . json_encode(array_keys($metrics)));
            
            // Get recent activities
            $recentActivities = $this->getRecentActivities($businessType);
            Log::info('Recent activities loaded successfully');
            
            // Get charts data
            $chartsData = $this->getChartsData($businessType);
            Log::info('Charts data loaded successfully');
            
            Log::info('About to render view with businessType: ' . $businessType);
            
            return view('dashboard.unified', compact('metrics', 'recentActivities', 'chartsData', 'businessType'));
            
        } catch (\Exception $e) {
            Log::error('UnifiedDashboardController@index error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Return error view with fallback data
            return view('dashboard.unified', [
                'metrics' => $this->getFallbackMetrics(),
                'recentActivities' => [],
                'chartsData' => $this->getFallbackChartsData(),
                'businessType' => 'construction'
            ]);
        }
    }
    
    /**
     * Get metrics based on business type.
     */
    private function getBusinessMetrics(string $businessType): array
    {
        try {
            return match($businessType) {
                'construction' => $this->getConstructionMetrics(),
                'sales' => $this->getSalesMetrics(),
                'design' => $this->getDesignMetrics(),
                default => $this->getConstructionMetrics(),
            };
        } catch (\Exception $e) {
            Log::error('getBusinessMetrics error: ' . $e->getMessage());
            return $this->getFallbackMetrics();
        }
    }
    
    /**
     * Get fallback metrics.
     */
    private function getFallbackMetrics(): array
    {
        return [
            'total_projects' => 0,
            'active_projects' => 0,
            'inventory_value' => 0,
            'total_expenses' => 0,
            'pending_invoices' => 0,
            'completed_projects' => 0,
            'total_leads' => 0,
            'qualified_leads' => 0,
            'total_quotations' => 0,
            'converted_leads' => 0,
            'sales_revenue' => 0,
            'pending_quotations' => 0,
            'total_revenue' => 0,
            'profit_margin' => 0,
        ];
    }
    
    /**
     * Get fallback charts data.
     */
    private function getFallbackChartsData(): array
    {
        return [
            'monthly' => [],
            'business_type' => 'construction',
        ];
    }
    
    /**
     * Get construction metrics.
     */
    private function getConstructionMetrics(): array
    {
        try {
            $projects = DemoDataProvider::getConstructionProjects() ?? [];
            $inventory = DemoDataProvider::getConstructionInventory() ?? [];
            $expenses = DemoDataProvider::getConstructionExpenses() ?? [];
            $invoices = DemoDataProvider::getConstructionInvoices() ?? [];
            
            return [
                'total_projects' => count($projects),
                'active_projects' => count(array_filter($projects ?? [], fn($project) => ($project['status'] ?? '') === 'Active')),
                'inventory_value' => array_sum(array_column($inventory ?? [], 'total_value') ?? [0]),
                'total_expenses' => array_sum(array_column($expenses ?? [], 'amount') ?? [0]),
                'pending_invoices' => count(array_filter($invoices ?? [], fn($invoice) => ($invoice['status'] ?? '') === 'Pending')),
                'completed_projects' => count(array_filter($projects ?? [], fn($project) => ($project['status'] ?? '') === 'Completed')),
            ];
        } catch (\Exception $e) {
            Log::error('getConstructionMetrics error: ' . $e->getMessage());
            return $this->getFallbackMetrics();
        }
    }
    
    /**
     * Get sales metrics.
     */
    private function getSalesMetrics(): array
    {
        try {
            $leads = DemoDataProvider::getSalesLeads() ?? [];
            $quotations = DemoDataProvider::getSalesQuotations() ?? [];
            $invoices = DemoDataProvider::getSalesInvoices() ?? [];
            
            return [
                'total_leads' => count($leads),
                'qualified_leads' => count(array_filter($leads ?? [], fn($lead) => ($lead['status'] ?? '') === 'Qualified')),
                'total_quotations' => count($quotations),
                'converted_leads' => count(array_filter($leads ?? [], fn($lead) => ($lead['status'] ?? '') === 'Converted')),
                'sales_revenue' => array_sum(array_column($invoices ?? [], 'total') ?? [0]),
                'pending_quotations' => count(array_filter($quotations ?? [], fn($quotation) => ($quotation['status'] ?? '') === 'Pending')),
            ];
        } catch (\Exception $e) {
            Log::error('getSalesMetrics error: ' . $e->getMessage());
            return $this->getFallbackMetrics();
        }
    }
    
    /**
     * Get design metrics.
     */
    private function getDesignMetrics(): array
    {
        try {
            $projects = DemoDataProvider::getDesignProjects() ?? [];
            $expenses = DemoDataProvider::getDesignExpenses() ?? [];
            $invoices = DemoDataProvider::getDesignInvoices() ?? [];
            
            return [
                'active_projects' => count(array_filter($projects ?? [], fn($project) => ($project['status'] ?? '') === 'Active')),
                'completed_projects' => count(array_filter($projects ?? [], fn($project) => ($project['status'] ?? '') === 'Completed')),
                'total_revenue' => array_sum(array_column($invoices ?? [], 'total') ?? [0]),
                'total_expenses' => array_sum(array_column($expenses ?? [], 'amount') ?? [0]),
                'pending_invoices' => count(array_filter($invoices ?? [], fn($invoice) => ($invoice['status'] ?? '') === 'Pending')),
                'profit_margin' => $this->calculateProfitMargin(),
            ];
        } catch (\Exception $e) {
            Log::error('getDesignMetrics error: ' . $e->getMessage());
            return $this->getFallbackMetrics();
        }
    }
    
    /**
     * Get recent activities based on business type.
     */
    private function getRecentActivities(string $businessType): array
    {
        try {
            return match($businessType) {
                'construction' => $this->getConstructionActivities(),
                'sales' => $this->getSalesActivities(),
                'design' => $this->getDesignActivities(),
                default => $this->getConstructionActivities(),
            };
        } catch (\Exception $e) {
            Log::error('getRecentActivities error: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Get construction activities.
     */
    private function getConstructionActivities(): array
    {
        try {
            return [
                [
                    'type' => 'project',
                    'title' => 'New project created',
                    'description' => 'Office Complex Construction',
                    'time' => '2 hours ago',
                    'icon' => 'bi-building',
                    'color' => 'primary'
                ],
                [
                    'type' => 'expense',
                    'title' => 'Material purchased',
                    'description' => 'Cement - 100 bags',
                    'time' => '5 hours ago',
                    'icon' => 'bi-box-seam',
                    'color' => 'warning'
                ],
                [
                    'type' => 'invoice',
                    'title' => 'Invoice paid',
                    'description' => 'INV-2024-001 - ₹531,000',
                    'time' => '1 day ago',
                    'icon' => 'bi-file-earmark-text',
                    'color' => 'success'
                ],
            ];
        } catch (\Exception $e) {
            Log::error('getConstructionActivities error: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Get sales activities.
     */
    private function getSalesActivities(): array
    {
        try {
            return [
                [
                    'type' => 'lead',
                    'title' => 'New lead added',
                    'description' => 'Rahul Sharma - UPVC Windows',
                    'time' => '1 hour ago',
                    'icon' => 'bi-person-plus',
                    'color' => 'info'
                ],
                [
                    'type' => 'quotation',
                    'title' => 'Quotation sent',
                    'description' => 'Q-2024-007 - ₹45,000',
                    'time' => '3 hours ago',
                    'icon' => 'bi-file-text',
                    'color' => 'warning'
                ],
                [
                    'type' => 'conversion',
                    'title' => 'Lead converted',
                    'description' => 'Priya Patel - Deal closed',
                    'time' => '1 day ago',
                    'icon' => 'bi-check-circle',
                    'color' => 'success'
                ],
            ];
        } catch (\Exception $e) {
            Log::error('getSalesActivities error: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Get design activities.
     */
    private function getDesignActivities(): array
    {
        try {
            return [
                [
                    'type' => 'project',
                    'title' => 'Project completed',
                    'description' => 'Living Room Makeover',
                    'time' => '2 hours ago',
                    'icon' => 'bi-palette',
                    'color' => 'success'
                ],
                [
                    'type' => 'expense',
                    'title' => 'Material purchased',
                    'description' => 'Fabric - Sofa set',
                    'time' => '5 hours ago',
                    'icon' => 'bi-box-seam',
                    'color' => 'warning'
                ],
                [
                    'type' => 'invoice',
                    'title' => 'Invoice paid',
                    'description' => 'INV-2024-001 - ₹159,300',
                    'time' => '2 days ago',
                    'icon' => 'bi-file-earmark-text',
                    'color' => 'success'
                ],
            ];
        } catch (\Exception $e) {
            Log::error('getDesignActivities error: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Get charts data based on business type.
     */
    private function getChartsData(string $businessType): array
    {
        try {
            // Generate sample data for charts
            $monthlyData = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthlyData[] = [
                    'month' => date('M', mktime(0, 0, 0, $i, 1, 2024)),
                    'revenue' => rand(50000, 200000),
                    'expenses' => rand(20000, 80000),
                ];
            }
            
            return [
                'monthly' => $monthlyData,
                'business_type' => $businessType,
            ];
        } catch (\Exception $e) {
            Log::error('getChartsData error: ' . $e->getMessage());
            return $this->getFallbackChartsData();
        }
    }
    
    /**
     * Calculate profit margin.
     */
    private function calculateProfitMargin(): float
    {
        try {
            $invoices = DemoDataProvider::getDesignInvoices() ?? [];
            $expenses = DemoDataProvider::getDesignExpenses() ?? [];
            
            $totalRevenue = array_sum(array_column($invoices ?? [], 'total') ?? [0]);
            $totalExpenses = array_sum(array_column($expenses ?? [], 'amount') ?? [0]);
            
            if ($totalRevenue == 0) {
                return 0;
            }
            
            return round((($totalRevenue - $totalExpenses) / $totalRevenue) * 100, 2);
        } catch (\Exception $e) {
            Log::error('calculateProfitMargin error: ' . $e->getMessage());
            return 0;
        }
    }
}
