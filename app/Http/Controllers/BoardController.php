<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function store(){

        request()->validate([
            'board' => 'required|min:5|max:100',
        ]);

        $board = Board::create(
            [
                'content' => request()->get('board',''),
            ]
        );

        return redirect()->route('dashboard')->with('success','Idea created successfully!');
    }
    public function destroy(Board $board){

        $board->delete();

        return redirect()->route('dashboard')->with('success','Idea deleted successfully!');

    }

    public function show(Board $board)
    {
        return view('boards.show',compact('board'));
    }

    public function edit(Board $board)
    {
        $editing = true;
        return view('boards.show',compact('board','editing'));

    }

    public function update(Board $board)
    {

        request()->validate([
            'board' => 'required|min:5|max:100',
        ]);

        $board->content = request()->get('board','');
        $board->save();

        return redirect()->route('board.show', $board->id);

    }

}
