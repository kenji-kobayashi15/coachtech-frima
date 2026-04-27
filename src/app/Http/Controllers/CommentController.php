<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $itemId)
    {
        $request->validate([
            'comment' => 'required|max:255',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'item_id' => $itemId,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'コメントを投稿しました。');
    }
}
