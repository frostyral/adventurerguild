<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $boards = $user->boards()->paginate(5);
        return view('users.show',compact('user','boards'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $editing = true;
        $boards = $user->boards()->paginate(5);
        return view('users.edit',compact('user','editing','boards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validated = request()->validate([
            'name' => 'required|min:5|max:30',
            'about' => 'nullable|min:1|max:50',
            'image' =>  'image'
        ]);

        //dd($validated);
        if(request()->has('image')){
            $imagePath = request()->file('image')->store('profile','public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);

        return redirect()->route('profile');
    }

    public function profile(){
        return $this->show(auth()->user());
    }
}
