<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class AdminController extends Controller
{
    public function showDashboard() {
        return view('admin.dashboard');
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
