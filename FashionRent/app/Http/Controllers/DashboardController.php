<?php

namespace App\Http\Controllers;

use App\Models\Fashion;
use App\Models\User;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $fashionCount = Fashion::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $rentlogs = RentLogs::with('user', 'fashion')->paginate(10);

        return view('dashboard', ['fashion_count' => $fashionCount, 'category_count' => $categoryCount, 'user_count' => $userCount, 'rent_logs' => $rentlogs]);
    }
}
