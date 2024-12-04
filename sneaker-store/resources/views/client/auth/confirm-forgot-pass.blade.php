<div class="">
    <h4>Xin chào {{ $user->fullname }}</h4>
    <p>
        Chúng tôi vừa nhận được thông tin khôi phục mật khẩu từ bạn vào lúc {{ $now }}.
        Vui lòng nhập vào liên kết bên dưới để khôi phục mật khẩu của bạn.
        <div>
            <a href="{{ route('reset-password', $token) }}">Click vào đây để khôi phục mật khẩu.</a>
        </div>
    </p>
</div>
