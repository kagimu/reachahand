<?php

namespace App\Http\Controllers;

use App\Models\User;
use Storage;
use Str;
use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Models\PhoneVerification;
use Hash;
use App\Helpers\SMS;


class UserController extends Controller
{
       public function index_clients()
    {
        session(['title' => 'Clients']);
        $role = 'client';
        $users = User::where('role', 'client')->orderBy('id', 'desc')->get();
        return view('users.index', compact('users', 'role'));
    }

    public function index_support()
    {
        session(['title' => 'Admin']);
        $role = 'support';
        $users = User::where('role', 'support')->orderBy('id', 'desc')->get();
        return view('users.index', compact('users', 'role'));
    }

    public function activate($id)
    {
        $user = User::find($id);
        if ($user->active == 0) {
            $user->active = 1;
            $message = 'client has been activated';
        } else {
            $user->active = 0;
            $message = 'client has been de-activated';
        }
        $user->save();

        return redirect()->back()->with(['message' => $message]);
    }


    public function getProfile(Request $request)
    {
     $user = User::with('posts')->withCount('posts')->find(Auth::id());
        
        return response()->json($user);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->first_name = !is_null($request->first_name) ? $request->first_name : $user->first_name;
        $user->last_name = !is_null($request->phone) ? $request->phone : $user->phone;
        $user->phone = !is_null($request->phone) ? $request->phone : $user->phone;
        $user->email = !is_null($request->email) ? $request->email : $user->email;
        $user->passwordpassword = !is_null($request->password) ? $request->password : $user->password;
        $user->save();
        return response()->json($user);
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('image')) {
            $str = Str::random(30);
            $uniqueFileName = $str . "." . $request->image->getClientOriginalExtension();
            $url = url(Storage::url($request->image->storeAs('/users', $uniqueFileName, 'public')));
            $user->image = $url;
        }
        $user->save();
        return response()->json($user);
    }

    public function updateFCMToken(Request $request){
        $user = Auth::user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json($user);
    }

    public function registerClient(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->role = "client";
        $user->save();


        $access_token_example = $user->createToken('LaravelAuthApp')->accessToken;
        //return the access token we generated in the above step
        $user->token = $access_token_example;

        return response()->json($user, 200);
    }

    public function registerSupport(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->role = "support";
        $user->active = 0;
        $user->save();


        $access_token_example = $user->createToken('LaravelAuthApp')->accessToken;
        //return the access token we generated in the above step
        $user->token = $access_token_example;

        return response()->json($user, 200);
    }

    public function uploadImage(Request $request)
    {
        $user = new User;
        $array = array();
        foreach ($request->file('images') as $image) {
            $str = Str::random(30);
            $uniqueFileName = $str . "." . $image->getClientOriginalExtension();
            $url = url(Storage::url($image->storeAs('/users', $uniqueFileName, 'public')));
            array_push($array, $url);
        }
        $user->images = $array;
        $user->save();
        return response()->json($user);

    }

    public function loginUserExample(Request $request)
    {
        $login_credentials = [
            'phone' => $request->phone,
            'password' => $request->password,
            'active' => 1,
        ];

        if (auth()->attempt($login_credentials)) {
            //generate the token for the user
            $user_login_token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            //now return this token on success login attempt
            $user = auth()->user();
            $user->token = $user_login_token;
            return response()->json($user, 200);
        } else {
            //wrong login credentials, return, user not authorised to our system, return error code 401
            return response()->json(['error' => 'Wrong login credentials, UnAuthorised Access'], 401);
        }
    }
    public function forgotPassword(Request $request){
        $request->validate([
            'phone' => 'required|string',
        ]);
        $user = User::where('phone', $request->phone)->first();
        if(is_null($user)){
            return response()->json(['code'=> 0, 'message'=> 'User with this phone number ' . $request->phone . " does not exist"]);
        }

        if($user->active == 0){
            return response()->json(['code'=> 0, 'message'=> 'User account has been de-activated']);
        }

        $pv = PhoneVerification::where('phone', $request->phone)->first();
        if(is_null($pv)){
            $pv = new PhoneVerification;
        }
        $pv->phone = $user->phone;
        $pv->code = $this->generateRandomCode(5);
        $pv->verified = 0;
        $pv->save();

        $this->sms->sendCode($pv->phone, $pv->code);

        return response()->json(['code'=> 1, 'message'=> 'A verification code has been sent to this phone number ' . $user->phone]);
    }

    function generateRandomCode($length = 5) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function verifyCode(Request $request){
        $request->validate([
            'phone' => 'required',
            'code' => 'required',
        ]);

        $pv = PhoneVerification::where('phone', $request->phone)
            ->where('code', $request->code)->first();

        if(is_null($pv)){
            return response()->json(['code'=> 0, 'message'=>'Verification code is incorrect']);
        }

        $pv->verified = 1;
        $pv->save();

        return response()->json(['code'=> 1, 'message'=>'User has been verified']);
    }

    public function resetPassword(Request $request){
        $request->validate([
           'phone' => 'required',
           'password' => 'required',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if(is_null($user)){
            return response()->json(['code'=> 0, 'message'=>'User does not exist']);
        }

        $pv = PhoneVerification::where('phone', $user->phone)->first();
        if(is_null($pv)){
            return response()->json(['code'=> 0, 'message'=>'User can not reset password at this time.']);
        }
        if($pv->verified == 0){
            return response()->json(['code'=> 0, 'message'=>'User can not reset password at this time.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        $pv->verified = 0;
        $pv->save();

        return response()->json(['code'=> 1, 'message'=>'User has reset password successfully.']);
    }
}
