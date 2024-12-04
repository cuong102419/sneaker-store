<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function formLogin() {
        return view('client.auth.login');
    }
    public function login(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($data)) {
            if(Auth::user()->status == 'active') {
                if(Auth::user()->roll == 'admin') {
                    return redirect()->route('admin.dashbroad');
                }
                return redirect()->route('home')->with('success-auth', 'Đăng nhập thành công.');
            } else {
                Auth::logout(); 
                return redirect()->back()->with('message', 'Tài khoản bị khóa.');
            }   
        } else {
            return redirect()->back()->with('message', 'Email hoặc mật khẩu không đúng.');
        }
    }

    public function formRegister() {
        return view('client.auth.register');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'fullname' => ['required', 'min:2'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:4'],
            'confirm_password' => ['required', 'same:password'],
        ]);
        User::query()->create($data);
        return redirect()->route('formLogin')->with('message', 'Tạo tài khoản thành công. Vui lòng đăng nhập lại.');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home')->with('success-auth', 'Đăng xuất thành công.');
    }

    public function information() {
        return view('client.user.info');
    }

    public function changePassword(Request $request) {
        $data = $request->validate([
            'fullname' => ['required', 'min:2'],
            'password' => ['required', 'min:4'],
            'confirm_password' => ['required', 'same:password'],
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->update($data);
        return redirect()->back()->with('message', 'Cập nhật thành công.');
    }

    public function orderList() {
        $orders = Order::where('user_id', Auth::user()->id)->latest('id')->paginate(8) ?? null;
        $status = [
            'pending' => ['value' => 'Chờ xử lý', 'class' => 'text-warning'],
            'processing' => ['value' => 'Đang xử lý', 'class' => 'text-primary'],
            'completed' => ['value' => 'Hoàn thành', 'class' => 'text-success'],
            'cancelled' => ['value' => 'Hủy đơn', 'class' => 'text-danger'],
        ];

        return view('client.user.order', compact('orders', 'status'));
    }
}
