<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class DashboardController extends Controller
{
    public function home()
    {
        $tenant             = auth()->user()->tenant;
        $totalUsers         = User::where('tenant_id', $tenant->id)->count();
        $totalTables        = Table::count();
        $totalCategories    = Category::count();

        return view('admin.pages.home.home', compact('totalUsers', 'totalTables', 'totalCategories'));
    }
}
