<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Storage;
use Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    
    public function get_profile(){
        $Support = Auth::Support();
        return response()->json($Support);
    }

    public function getSupport($id){
        // Get a single post
        return response()->json(Support::find($id));
    }
  
    public function index() {
        $Supports['Supports'] = Support::orderBy('id','asc')->paginate(5);
        return view('Supports.index', $Supports);
    }

    public function update(Request $request, Support $Support, $id)
    {
       
        $request->validate([
           'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'required|unique:users',
            'email'=>'required',
            'password'=>'required'
        ]);
        
        $Support = Support::find($id);
        $support->first_name = $request->first_name;
        $support->last_name = $request->last_name;
        $support->phone = $request->phone;
        $support->password = bcrypt($request->password);
        $support->email = $request->email;
         $Support->save();
        return response()->json($Support);

    }

    public function registerSupport(Request $request){
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'required|unique:users',
            'email'=>'required',
            'password'=>'required'

        ]);

        $support = new Support;
        $support->first_name = $request->first_name;
        $support->last_name = $request->last_name;
        $support->phone = $request->phone;
        $support->password = bcrypt($request->password);
        $support->email = $request->email;
        $support->save();

       
        $access_token_example = $support->createToken('PassportExample@Section.io')->accessToken;
        //return the access token we generated in the above step
        $support->token = $access_token_example;

        return response()->json($support,200);
    }

    public function uploadImage(Request $request)
    {
        $Support = new Support;
        $array = array();
        foreach($request->file('images') as $image){
            $str = Str::random(30);
            $uniqueFileName = $str . ".". $image->getClientOriginalExtension();
            $url  = url(Storage::url($image->storeAs('/Supports', $uniqueFileName, 'public')));
            array_push($array, $url);
        }
        $Support->images = $array;
         $Support->save();
        return response()->json($Support);

    }

    public function loginSupportExample(Request $request){
        $login_credentials=[
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(auth()->attempt($login_credentials)){
            //generate the token for the Support
            $Support_login_token= auth()->Support()->createToken('PassportExample@Section.io')->accessToken;
            //now return this token on success login attempt
            $Support = auth()->Support();
            $Support->token = $Support_login_token;
            return response()->json($Support, 200);
        }
        else{
            //wrong login credentials, return, Support not authorised to our system, return error code 401
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
    }

    
    public function authenticatedSupportDetails(){
        //returns details
        return response()->json(['authenticated-Support' => auth()->Support()], 200);
    }
}
