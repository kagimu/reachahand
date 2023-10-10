<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use App\Models\Agent;

class DashboardController extends Controller
{
    public function dashboard(){
        session(['title' => 'Dashboard']);

        $posts = number_format(Post::count());
        $clients = number_format(User::where('role', 'client')->count());
        $support = number_format(User::where('role', 'support')->count());
        $agents = number_format(Agent::count());

        $support_users = User::where('role', 'support')->where('active', 0)->orderBy('created_at', 'desc')->get();
        $active_clients = User::where('role', 'client')->orderBy('created_at', 'desc')->take(10)->get();

        return view('dashboard', compact('posts', 'clients', 'support', 'agents', 'support_users', 'active_clients'));
    }
}

