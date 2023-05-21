<?php

namespace App\Http\Controllers;

use App\Models\Study;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Dashboard', [
            'newUsers' => User::whereBetween('created_at', [Carbon::now()->addDays(-30), Carbon::now()])->count(),
            'totalTeams' => Team::all()->count(),
            'studies' => [
                'team' => Study::where('team_id', $request->user()->current_team_id)->count(),
                'user' => $request->user()->studies()->count(),
                'all' => Study::all()->count(),
            ],
            'savedVerses' => [
                'user' => $request->user()->verses()->count(),
                'all' => DB::table('user_verse')->count(),
            ]
        ]);
    }
}
