<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
  
// show login page
public function login(){
    return view('account.login');
}

//show user detail
public function showAccount(){
   $user=User::find(Auth::user()->id);
    
    return view('account.account',['user'=>$user]);
}

// process on login input
public function loginProcess(Request $request){
    $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:4',
        ]);
        $credential=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(Auth::attempt($credential)){
            return redirect()->route('account.showAccount');
        }else{
            return redirect()->route('account.login')->with('error','Email or Password do not match');
        }
    }
    
    // logout redirect to login page
    public function logout(){
        Auth::logout();
        return redirect()->route('account.login')->with('success', 'You have been logged out.');
    }

    // show register front page
    public function showRegister(){
        return view('account.register');
    }

    public function registerProcess(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:4',
            'confirm_password'=>'required|same:password'
        ]);
        
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>'user',
        ]);
        return redirect()->route('account.login')->with('success','you have successfull create account');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'name'=>'required',
        ]);

        // update account profile name email  mobile number

        User::find(Auth::id())->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'number'=>$request->number,
       ]);
       return redirect()->route('account.showAccount')->with('success','profile updated successfull');
    }


    // update user password in profile
    public function updatePassword(Request $request){
        $request->validate([
            'old_password'=>'required|min:4',
            'new_password'=>'required|min:4|same:confirm_password',
            'confirm_password'=>'required|min:4'
        ]);

        $user= User::find(Auth::id());

       if(Hash::check($request->old_password,$user->password)){
        User::find(Auth::id())->update([
            'password'=>$request->new_password
        ]);
        return redirect()->route('account.showAccount')->with('success','password updated successfull');
    }else{
           return redirect()->route('account.showAccount')->with('error','password does not match');

       }

    }


    public function updateImage(Request $request){
        if($request->hasFile('image')){
            $old_image=User::find(Auth::id(),'image');
           if($old_image->image){
              $old_imagePath=public_path('profileImage/'.$old_image->image);
              File::delete($old_imagePath);
           }

            $image=$request->file('image');
            $ext=$image->getClientOriginalExtension();
            $imagename=time().'.'.$ext;
            $image->move(public_path('profileImage/'),$imagename);

            User::find(Auth::id())->update([
                'image'=>$imagename
            ]);
            return redirect()->route('account.showAccount')->with('success','profile image updated successfull');
        }else{
            return redirect()->back();
        }
        
    }
}
