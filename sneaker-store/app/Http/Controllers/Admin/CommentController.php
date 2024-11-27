<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $comments = Comment::when($search, function($query, $search) {
            return $query->where('id', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function($query) use ($search) {
                            $query->where('email', 'like', '%' . $search . '%');
                        });
        })->latest('id')->paginate(8);
        return view('admin.comment.index', compact('comments'));
    }

    public function destroy(Comment $comment) {
        $comment->delete();
        return redirect()->back()->with('success', 'Xóa thành công.');
    }
}
