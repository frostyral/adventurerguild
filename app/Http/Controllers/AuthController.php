<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Adventurer;



class AuthController extends Controller
{
    public function register(){
        return view("auth.register");
    }

    public function store()
{
    $validated = request()->validate([
        'name' => 'required|min:3|max:30|unique:adventurers,name',
        'class' => 'required|min:3',
        'password' => 'required|confirmed|min:5|max:20',
    ]);

    Adventurer::create([
        'name' => $validated['name'],
        'class' => $validated['class'],
        'password' => Hash::make($validated['password']),
    ]);

    return redirect()->route('dashboard')->with('success', 'Adventurer registered Successfully!');
}

}
