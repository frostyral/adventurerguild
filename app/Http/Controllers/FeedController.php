<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $followingIDs = auth()->user()->followings()->pluck("user_id");

        $board = Board::whereIn('user_id',$followingIDs)->latest();

        if(request()->has("search")){
            $board = $board->where('content','like','%' . request()->get('search','') . '%');
        }

        return view('dashboard',[
            'boards' => $board->paginate(5),
        ]);
    }
}
