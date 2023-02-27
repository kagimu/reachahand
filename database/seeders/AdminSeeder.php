<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admin = User::where('email','kagimujayp01@gmail.com')->first();
    	if(!$admin){
        	$admin = new User;
        }
        $admin->first_name = "Kagimu";
        $admin->last_name = "JohnPaul";
        $admin->phone = "0759632498";
        $admin->email = "kagimujayp01@gmail.com";
        $admin->password = Hash::make("12345");
        $admin->role = "admin";
        $admin->save();

        $admin2 = User::where('email','matovu.francisk@gmail.com ')->first();
        if(!$admin2){
            $admin2 = new User;
        }
        $admin->first_name = "Matovu";
        $admin->last_name = "Francis";
        $admin2->phone = "0750662136";
        $admin2->email = "matovu.francisk@gmail.com ";
        $admin2->password = Hash::make("12345");
        $admin2->role = "admin";
        $admin2->save();
    }
}