<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Hiển thị trang đăng nhập
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    // Hiển thị trang đăng ký
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.register');
    }

    // Xử lý đăng nhập
    public function postLogin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'username' => 'Tên đăng nhập',
                'password' => 'Mật khẩu',
            ]
        );

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()
                ->with('message', 'Username không tồn tại')
                ->withInput();
        }

        $check = Hash::check($request->password, $user->password);

        if (!$check) {
            return back()
                ->with('message', 'Mật khẩu không đúng')
                ->withInput();
        }

        $remember = $request->has('remember') ? true : false;
        Auth::login($user, $remember);

        return redirect()->intended(route('admin.dashboard'));
    }

    // Xử lý đăng ký
    public function postRegister(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [], [
            'fullname' => 'Họ tên',
            'username' => 'Tên đăng nhập',
            'email'    => 'Email',
            'password' => 'Mật khẩu',
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'status'   => 1,
            'phone'    => $request->phone ?? '',
        ]);

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // Hiển thị trang quên mật khẩu
    public function forgotPassword()
    {
        return view('admin.auth.forgotpass');
    }

    // Xử lý quên mật khẩu
    public function postForgotPassword(Request $request)
    {
        // Validate
        $request->validate(
            [
                'email' => 'required|email'
            ],
            [
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng'
            ]
        );

        // Kiểm tra email tồn tại
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->with('error', 'Email không tồn tại')
                ->withInput();
        }

        // Tạo mật khẩu mới
        $passwordRandom = Str::random(10);

        // Mã hóa mật khẩu
        $passwordEncrypt = Hash::make($passwordRandom);

        // Cập nhật vào database
        $user->update([
            'password' => $passwordEncrypt
        ]);

        // Nội dung email
        $html = "
            <h2>Mật khẩu mới của bạn là: $passwordRandom</h2>
            <p>Vui lòng đổi mật khẩu sau khi đăng nhập.</p>
        ";

        // Gửi email
        Mail::html($html, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Đặt lại mật khẩu');
        });

        return back()->with(
            'message',
            'Đã gửi mật khẩu mới vào Email.'
        );
    }

    // Hiển thị trang đổi mật khẩu
    public function changePassword()
    {
        return view('admin.auth.changepassword');
    }

    // Xử lý đổi mật khẩu
    public function postChangePassword(Request $request)
    {
        $request->validate(
            [
                'old_password'              => 'required',
                'new_password'              => 'required|min:6|different:old_password',
                'new_password_confirmation' => 'required|same:new_password',
            ],
            [
                'required'  => ':attribute không được để trống.',
                'min'       => ':attribute phải từ :min ký tự trở lên.',
                'different' => ':attribute phải khác mật khẩu cũ.',
                'same'      => ':attribute không khớp.',
            ],
            [
                'old_password'              => 'Mật khẩu cũ',
                'new_password'              => 'Mật khẩu mới',
                'new_password_confirmation' => 'Xác nhận mật khẩu mới',
            ]
        );

        $user = Auth::user();

        // Kiểm tra mật khẩu cũ có đúng không
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Mật khẩu cũ không đúng')->withInput();
        }

        // Cập nhật mật khẩu mới
        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công.');
    }
}
