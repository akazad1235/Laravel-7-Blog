<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\registerRequest;
use App\User;
class AuthController extends Controller
{
    
    public function registerForm(){

    	return view('register');
    }

    public function register(Request $request){


         $validatedData = $request->validate([

            'name'                  => 'required',
            'email'                 => 'required|email',
            'image'                 => 'required|image',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
         ]);

       try {
            $image    = $request->file('image');
            $fileName = rand(0, 999999999) . '_' . date('Ymdhis') . '_' . rand(99999, 999999999) . '.' . $image->getClientOriginalExtension();
            if ($image->isValid()) {
                if ($image->getMimeType() === "image/png" || $image->getMimeType() === "image/jpeg") {
                    $image->storeAs('users', $fileName);
                } else {
                    $this->errorMessage("Something wrong!");
                    return redirect()->back();
                }
            }

            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
                'image'    => $fileName,
            ]);

            $this->successMessage("Data seve success!");
            return redirect()->back();
        } catch (\Exception $e) {
            $this->errorMessage("Something wrong!");
            return redirect()->back();
        }
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
       
        $data = $request->except('_token');
        if(auth()->attempt($data)){

             return redirect()->route('home');
        }
       return redirect()->route('loginForm');

    }


    public function logout(){
        auth()->logout();
        return redirect()->route('loginForm');
    }
}
