<?php
/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 26/03/2022
 * Time: 17:38
 */

namespace App\Helpers;

use Kutia\Larafirebase\Facades\Larafirebase;
use App\Models\User;

class FCM
{
    public function newPost($user){
        $supportTokens = User::where('role', 'support')->pluck('fcm_token')->toArray();

        try{
            return Larafirebase::fromArray([
                'action' => 1,
                'title' => 'New Post',
                'message' => $user->name . " has posted a new post"
            ])->sendMessage($supportTokens);

        }catch (\Exception $e){
            return "An error occurred while sending notification";
        }
    }
}