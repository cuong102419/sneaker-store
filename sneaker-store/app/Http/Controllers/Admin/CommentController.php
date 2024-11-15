<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        $comments = Comment::query()->latest('id')->paginate(8);
        return view('admin.comment.index', compact('comments'));
    }

    public function destroy(Comment $comment) {
        $comment->delete();
        return redirect()->back()->with('success', 'Xóa thành công.');
    }
}
