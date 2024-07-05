<?php

namespace App\Http\Controllers;

use App\Models\Impact;
use App\Models\Partner;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        session(['title' => 'Dashboard']);

        $posts = number_format(Post::count());
        $impacts = number_format(Impact::count());
        $partners = number_format(Partner::count());
        $clients = number_format(User::where('role', 'client')->count());

        $active_clients = User::withCount(['posts', 'impacts'])
            ->where('role', 'client')
            ->orderByDesc(DB::raw('posts_count + impacts_count'))
            ->take(10)
            ->get();

        return view('dashboard', compact('posts', 'impacts', 'partners', 'clients', 'active_clients'));
    }
}
