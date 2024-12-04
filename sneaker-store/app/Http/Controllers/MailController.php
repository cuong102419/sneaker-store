<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function forgot_password()
    {
        return view('client.auth.forgot-pass');
    }

    public function recover_password(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);
        // Mail::to($data['email'])->send(new ForgotPassword());
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i d-m-Y');
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            $token = Str::random(40);
            $user->user_token = $token;
            $user->save();
            Mail::to($data['email'])->send(new ForgotPassword($user, $token, $now));
            
            return redirect()->back()->with('message', 'Gửi thành công. Vui lòng kiểm tra email.');
        } else {
            return redirect()->back()->with('message', 'Email chưa được đăng ký để khôi phục mật khẩu.');
        }

    }

    public function reset_password($token) {
        $user = User::where('user_token', $token)->first();

        if($user) {
            return view('client.auth.reset-pass', compact('token'));
        } else {
            return redirect()->route('formLogin')->with('message', 'Email đã được khôi phục mật khẩu, vui lòng đăng nhập.');
        }
    }

    public function change_password(Request $request, $token) {
        $data = $request->validate([
            'password' => ['required', 'min:4'],
            'confirm-password' => ['required', 'same:password'],
        ]);
        $newToken = $request->input('_token');

        $user = User::where('user_token', $token)->first();
        $user->password = $data['password'];
        $user->user_token = $newToken;
        $user->save();

        return redirect()->route('formLogin')->with('message', 'Đổi mật khẩu thành công. Vui lòng đăng nhập lại.');
    }
}
