<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function store(){

        $validated = request()->validate([
            'content' => 'required|min:5|max:100',
        ]);

        $validated['user_id'] = auth()->id();


        Board::create($validated);

        return redirect()->route('dashboard')->with('success','Board created successfully!');
    }
    public function destroy(Board $board){

        if(auth()->id() !== $board->user_id){
            abort(404,'');
        }

        $board->delete();

        return redirect()->route('dashboard')->with('success','Idea deleted successfully!');

    }

    public function show(Board $board)
    {
        return view('boards.show',compact('board'));
    }

    public function edit(Board $board)
    {

        if(auth()->id() !== $board->user_id){
            abort(404,'');
        }

        $editing = true;
        return view('boards.show',compact('board','editing'));

    }

    public function update(Board $board)
    {

        if(auth()->id() !== $board->user_id){
            abort(404,'');
        }

        $validated = request()->validate([
            'board' => 'required|min:5|max:100',
        ]);

        $board->update($validated);


        return redirect()->route('board.show', $board->id)->with('success','Board updated successfully!');

    }

}
