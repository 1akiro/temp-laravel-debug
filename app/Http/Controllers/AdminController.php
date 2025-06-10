<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
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

    public function activities()
    {
        $activities = Activity::select(
            'activities.id',
            'activities.created_at',
            'users.name as user_name',
            'tours.title as tour_title',
            'activity_types.action as activity_action'
        )
            ->leftJoin('users', 'activities.user_id', '=', 'users.id')
            ->leftJoin('tours', 'activities.tour_id', '=', 'tours.id')
            ->leftJoin('activity_types', 'activities.activity_type_id', '=', 'activity_types.id')
            ->latest('activities.created_at')
            ->get();

        return view('admin.activities', [
            'activities' => $activities,
            'title' => 'Aktivitāšu žurnāls'
        ]);
    }

}
