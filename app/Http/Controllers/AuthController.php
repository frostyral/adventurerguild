<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;




class AuthController extends Controller
{
    public function register(){
        return view("auth.register");
    }

    public function store()
{
    $validated = request()->validate([
        'name' => 'required|min:3|max:30|unique:users,name',
        'class' => 'required|min:3',
        'password' => 'required|confirmed|min:5|max:20',
    ]);

    User::create([
        'name' => $validated['name'],
        'class' => $validated['class'],
        'password' => Hash::make($validated['password']),
    ]);

    return redirect()->route('dashboard')->with('success', 'Adventurer registered Successfully!');
}

    public function login(){
        return view("auth.login");
    }

    public function authenticate()
    {

        //dd(request()->all());

        $validated = request()->validate([
            'name' => 'required|min:3|max:30|',
            'password' => 'required|min:5|max:20',
        ]);

        // Adventurer::create([
        //     'name' => $validated['name'],
        //     'class' => $validated['class'],
        //     'password' => Hash::make($validated['password']),
        // ]);

    if(auth()->attempt($validated)){
        request()->session()->regenerate();

        return redirect()->route('dashboard')->with('success','Logged in successfully!');
    }

    return redirect()->route('login')->withErrors([
        'name' => "No matching adventurer found with the provided name and password"
    ]);
    }

    public function logout(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route("dashboard")->with("success","Logged out successfully!");
    }

}
