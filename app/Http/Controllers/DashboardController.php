<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Project;
use App\Models\Inventory;
use App\Models\Lead;
use App\Models\Quotation;
use App\Models\Invoice;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $business = $request->attributes->get('business');
        $businessId = $business->id;
        $businessType = $business->type;

        // Get dashboard data based on business type
        $data = $this->getDashboardData($businessType, $businessId);

        return view('dashboard.index', compact('data', 'business'));
    }

    public function stats(Request $request)
    {
        $business = $request->attributes->get('business');
        $businessId = $business->id;
        $businessType = $business->type;

        return response()->json($this->getDashboardData($businessType, $businessId));
    }

    private function getDashboardData($businessType, $businessId)
    {
        $data = [];

        switch ($businessType) {
            case 'construction':
                $data = [
                    'total_projects' => Project::forBusiness($businessId)->count(),
                    'total_inventory_value' => Inventory::forBusiness($businessId)->get()->sum(function ($item) {
                        return $item->quantity * $item->unit_price;
                    }),
                    'total_expenses' => Expense::forBusiness($businessId)->sum('amount'),
                    'total_projects_revenue' => Project::forBusiness($businessId)->whereNotNull('actual_cost')->sum('actual_cost'),
                    'projects_by_status' => Project::forBusiness($businessId)
                        ->selectRaw('status, COUNT(*) as count')
                        ->groupBy('status')
                        ->get(),
                ];
                $data['simple_profit'] = $data['total_projects_revenue'] - $data['total_expenses'];
                break;

            case 'upvc':
                $data = [
                    'total_leads' => Lead::forBusiness($businessId)->count(),
                    'converted_leads' => Lead::forBusiness($businessId)->converted()->count(),
                    'total_quotations' => Quotation::forBusiness($businessId)->count(),
                    'total_sales' => Invoice::forBusiness($businessId)->paid()->sum('total_amount'),
                    'leads_by_status' => Lead::forBusiness($businessId)
                        ->selectRaw('status, COUNT(*) as count')
                        ->groupBy('status')
                        ->get(),
                ];
                break;

            case 'interior':
                $data = [
                    'active_projects' => Project::forBusiness($businessId)->where('status', 'active')->count(),
                    'total_revenue' => Invoice::forBusiness($businessId)->paid()->sum('total_amount'),
                    'total_expenses' => Expense::forBusiness($businessId)->sum('amount'),
                    'projects_by_status' => Project::forBusiness($businessId)
                        ->selectRaw('status, COUNT(*) as count')
                        ->groupBy('status')
                        ->get(),
                ];
                $data['margin_percentage'] = $data['total_revenue'] > 0 
                    ? (($data['total_revenue'] - $data['total_expenses']) / $data['total_revenue']) * 100 
                    : 0;
                break;
        }

        return $data;
    }
}
