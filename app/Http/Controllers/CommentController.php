<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Board $board){

        request()->validate([
            'content' => 'required|min:1|max:50',
        ]);

        $comment = new Comment();
        $comment->board_id = $board->id;
        $comment->content = request()->get('content');
        $comment->save();

        return redirect()->route('board.show', $board->id);
    }
}
