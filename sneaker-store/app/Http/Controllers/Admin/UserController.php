<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
                return $query->where('id', 'like', '%' . $search . '%')
                    ->orWhere('fullname', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->latest('id')
            ->paginate(8);
        $status = [
            'active' => ['value' => 'Hoạt động', 'class' => 'text-success'],
            'deactive' => ['value' => 'Ngừng hoạt động', 'class' => 'text-danger'],
        ];
        $roll = [
            'admin' => ['value' => 'Quản trị', 'class' => 'text-danger'],
            'user' => ['value' => 'Người dùng', 'class' => 'text-primary'],
        ];

        return view('admin.user.index', compact('users', 'status', 'roll'));
    }

    public function banAccount(User $user)
    {
        $user->status = 'deactive';
        $user->save();
        return redirect()->back()->with('message', 'Cập nhật thành công.');
    }

    public function unbanAccount(User $user)
    {
        $user->status = 'active';
        $user->save();
        return redirect()->back()->with('message', 'Cập nhật thành công.');
    }
}
