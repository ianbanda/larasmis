<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    //
    public function index()
    {
        //return 'hello';
        return view('authentication.login');
        //$this->loginScreen();
    }

    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        //return 'logging in';
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            if($request->is('api/*')) {
                $u = Auth::user();
                $users = new Users();
                $data = $users->getUserProfile($u['ID']);

                $jsonObject = "{user:{";
                //$this->jsonObject = "{\"user\":{";
                
                $data = $data[0];
                /*foreach ($data as $field => $v) {
                    
                    //$this->jsonObject .= $field.":".$data.", ";
                    $jsonObject .= "\"".$field."\":\"".$v."\", ";
                    
                }
                $jsonObject .= "}}";

                

                //return response()->json($data);
                return response()->json($jsonObject);
                //return response()->json("{\"user\":".$data."}");*/
                return response()->json(['user'=>$data]);
            } else {
                return redirect()->intended('dashboard')->withSuccess('Signed in');
            }
        } 
        else
        {
            if($request->is('api/*')) {
                //$classjo = ['classstudents'=>$classstudents];
                return Hash::make($request['auth_pass']);
            //return "Signin Error, please try again";
            } else {
                return redirect("/authentication/logout")->withSuccess('Login details are not valid');
            }
        }
    }
    public function loginScreen()
    {
        return view('authentication.login');
    }
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        /*if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');*/
        return $request;
    }

    public function registration()
    {
        return view('authentication.registration');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'username' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('authentication/login');
    }
}
