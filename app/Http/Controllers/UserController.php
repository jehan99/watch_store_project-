<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    
    
    public function user_registration(Request $request){
        

        $incomingFields = $request ->validate([

            'name'=>['required', Rule::unique('users','name')],
            'email'=>['required', Rule::unique('users','email')],
            'password'=>['required', 'max:10', 'min:6', 'confirmed'] ,

        ]);


       $incomingFields ['password'] = bcrypt($incomingFields['password']);
       $incomingFields['role'] = 'user';


       $user = User::create($incomingFields);
       auth()->login($user);
       session(['user_name' => $user->name]);

        return 
        redirect()->route('homePage');

}
    
    public function logout (Request $request){    
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('homePage');
        
            }
            
        public function login(){
        
            return view('LoginPg');
        }
        

    

        public function user_login (Request $request) {
        
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        
            // Attempt to log in
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                    if (Auth::user()->status !== 'active') {
                        Auth::logout();
                        return view('block-suspenedPg');
                    }
        
                
                if (Auth::user()->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('homePage');
                }
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


        public function displayUserList(){

            $users = User::select('id','name','email','created_at','status')->get();
        
            return view('admin.cutomerListPg', compact('users'));
        }




        public function updateUserStatus(Request $request, $id)
        {
            $user = User::findOrFail($id);
        
            $request->validate([
                'status' => 'required|in:active,deactive,block'
            ]);
        
            $user->status = $request->status;
            $user->save();
        
            return redirect()->back()->with('success', 'User status updated!');
        }
       


//CHANGE PASSWORD 


public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'new_password' => ['required','min:6','max:10','confirmed'],
    ]);

    $user = Auth::user();

    // Check current password
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors([
            'current_password' => 'Current password is incorrect'
        ]);
    }

    // Update password
    $user->password = bcrypt($request->new_password);
    $user->save();

    return back()->with('success', 'Password changed successfully!');
}





}



