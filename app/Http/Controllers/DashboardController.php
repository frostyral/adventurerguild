<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $board = Board::orderBy("created_at","DESC");

        if(request()->has("search")){
            $board = $board->where('content','like','%' . request()->get('search','') . '%');
        }

        return view('dashboard',[
            'boards' => $board->paginate(5),
        ]);
    }
}
