<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserOnlineStatus extends Command
{
    protected $signature = 'user-online-status:update';

    protected $description = 'Update user status to offline at 12 AM every day';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::where('online', true)
            ->where('last_activity', '<', now()->startOfDay())
            ->get();

        foreach ($users as $user) {
            // Set online status to false
            $user->update(['online' => false]);
        }

        $this->info('User status updated successfully.');
    }
}
