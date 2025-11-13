<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    
    public function user_registration(Request $request){
        

        $incomingFields = $request ->validate([

            'name'=>['required', Rule::unique('users','name')],
            'email'=>['required', Rule::unique('users','email')],
            'password'=>['required', 'max:10', 'min:6'] ,
            'con-password'=>'required',

        ]);

       $incomingFields ['password'] = bcrypt($incomingFields['password']);
       $user = User::create($incomingFields);
       auth()->login($user);
       session(['user_name' => $user->name]);

        return 
        redirect('HomePage');


    }
    public function logout (Request $request){    
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('showLoginForm');
        
            }
            
        public function login(){
        
            return view('/LoginPg');
        }
        

        public function regUser_to_Login(){

            return redirect('LoginPg');
        }
        
        public function user_login (Request $request) {
        
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        
            // Attempt to log in
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended ('HomePage');;
            }
        
            // Failed login
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        
        }

        

        public function displayUserAccount() {

$user = Auth::user();

            return view('/UserAccountPg', compact('user'));
        }

}



