<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
        $events = number_format(Event::count());
        $partners = number_format(Partner::count());
        $clients = number_format(User::where('role', 'client')->count());

        $active_clients = User::withCount(['posts',])
            ->where('role', 'client')
            ->orderByDesc(DB::raw('posts_count'))
            ->take(10)
            ->get();

        return view('dashboard', compact('posts', 'events', 'partners', 'clients', 'active_clients'));
    }
}
