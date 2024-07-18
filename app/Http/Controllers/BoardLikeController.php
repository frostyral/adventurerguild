<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardLikeController extends Controller
{
    public function like(Board $board){
        $liker = auth()->user();
        $liker->likes()->attach($board);

        return redirect()->route('dashboard')->with('success','liked successfully!');
    }

    public function unlike(Board $board){
        $liker = auth()->user();
        $liker->likes()->detach($board);

        return redirect()->route('dashboard')->with('success','Unliked successfully!');
    }
}
