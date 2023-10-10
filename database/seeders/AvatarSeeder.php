<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Laravolt\Avatar\Avatar;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  //       $users = User::where('image', null)->get();
		// foreach($users as $user){
		// 	$user->image = Avatar::create($user->last_name . " " . $user->first_name)->toBase64();
		// 	$user->save();
		// }
		echo (string)Avatar::create(strtoupper("jayp"))->toBase64();
    }
}
