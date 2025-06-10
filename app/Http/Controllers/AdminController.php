<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Tour;
use App\Models\TourView;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function showDashboard() {
        $user = Auth::user();

        $totalViews = TourView::count();

        $viewsLast7Days = TourView::where('viewed_at', '>=', Carbon::now()->subDays(7))->count();

        $viewsToday = TourView::whereDate('viewed_at', Carbon::today())->count();

        $topTours = Tour::select('tours.id', 'tours.title', 'tours.slug', DB::raw('COUNT(tour_views.id) as view_count'))
            ->leftJoin('tour_views', 'tours.id', '=', 'tour_views.tour_id')
            ->groupBy('tours.id', 'tours.title', 'tours.slug')
            ->orderByDesc('view_count')
            ->limit(5)
            ->get();

        $dailyViews = TourView::select(DB::raw('DATE(viewed_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('viewed_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    
        $viewDates = $dailyViews->pluck('date');
        $viewCounts = $dailyViews->pluck('count');

        $activeUsers = User::select('users.id', 'users.name', 'users.email', DB::raw('COUNT(tour_views.id) as view_count'))
            ->leftJoin('tour_views', 'users.id', '=', 'tour_views.user_id')
            ->whereNotNull('tour_views.user_id')
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderByDesc('view_count')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'user', 
            'totalViews', 
            'viewsLast7Days', 
            'viewsToday', 
            'topTours', 
            'dailyViews',
            'viewDates',
            'viewCounts',
            'activeUsers'
        ));
    }
}
