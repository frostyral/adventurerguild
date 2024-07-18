<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'content' => 'nullable|min:5|max:100',
            'media' => 'nullable|image',
        ]);

        if($request->hasFile('media')) {
            $imagePath = $request->file('media')->store('boardmedia', 'public');
            $validated['media'] = $imagePath;
        }

        $validated['user_id'] = auth()->id();

        Board::create($validated);

        return redirect()->route('dashboard')->with('success', 'Board created successfully!');
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

    public function update(Board $board, Request $request)
    {
        if(auth()->id() !== $board->user_id) {
            abort(404, '');
        }

        $validated = $request->validate([
            'content' => 'required|min:5|max:100',
            'media' => 'nullable|image',
        ]);

        if($request->hasFile('media')) {
            // Delete the old image if it exists
            if($board->media) {
                Storage::disk('public')->delete($board->media);
            }
            // Store the new image
            $imagePath = $request->file('media')->store('boardmedia', 'public');
            $validated['media'] = $imagePath;
        }

        $board->update($validated);
        return redirect()->route('board.show', $board->id)->with('success', 'Board updated successfully!');
    }


}
