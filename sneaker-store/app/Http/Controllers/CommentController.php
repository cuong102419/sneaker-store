<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request) {
        if(Auth::check()) {
            $data = $request->validate([
                'content' => ['required', 'min:2'],
                'product_id' => ['nullable'],
            ]);
            $data['user_id'] = Auth::user()->id;
            Comment::query()->create($data);
            
            return redirect()->back()->with('successComment', 'Đánh giá đã được gửi.');
        }
    }
}
