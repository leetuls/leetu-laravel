<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function customLogin(Request $request)
    {

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $password = Crypt::encrypt($request->get('password'));
            return redirect()->intended('home')
                ->withSuccess('Signed in');
        }

        return redirect()->route('admin.index')->with('error_login_message', 'Email hoặc mật khẩu không chính xác!');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($request->get('password') !== $request->get('re_password')) {
            return redirect()->route('admin.index')->with('error_signup_message', 'Xác nhận mật khẩu không chính xác!');
        }

        $data = $request->all();
        $user = $this->_create($data);
        Auth::login($user);

        return redirect()->route('home');
    }

    private function _create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('admin.index');
    }

    public function showProfile()
    {
        return view('profile.profile');
    }

    public function updateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        if (!empty($user)) {
            if ($request->hasFile('image_profile')) {
                // Do something with the file
                $file = $request->file('image_profile');
                $fileName = $request->file('image_profile')->getClientOriginalName();
                $file->move(public_path('//img/'), $fileName);
                $user->image = $fileName;
            }
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->save();
        }
        return redirect()->route('admin.profile')->with('updated_profile', 'Cập nhật thông tin thành công!');
    }

    public function changePasswordIndex(Request $request)
    {
        if ($request->ajax()) {
            $returnHTML = view('profile.re-password')->render();
            return response(['html' => $returnHTML]);
        }
    }

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->get('old_pw'), $user->password)) {
            return redirect()
                ->route('admin.profile')
                ->with('error_changed', 'Bạn đã nhập sai mật khẩu!');
        } else if (
            $request->get('new_pw') !== $request->get('re_new_pw')
        ) {
            return redirect()
                ->route('admin.profile')
                ->with('error_changed', 'Xác nhận mật khẩu mới không khớp nhau!');
        } else {
            $user->password = Hash::make($request->get('new_pw'));
            $user->save();
            return redirect()->route('admin.profile')->with('updated_profile', 'Đổi mật khẩu thành công!');
        }
    }

    public function resetPassword(Request $request)
    {
        $email  = $request->get('email_reset');
        $user = User::where('email', $email)->first();
        if (!empty($user)) {
            $password = uniqid();
            $user->password = Hash::make($password);
            Mail::to($email)->send(new ResetPasswordMail($password));
            $user->save();
            return redirect()->route('admin.index')->with('reset_success', 'Đã yêu cầu thiết định lại mật khẩu, hệ thống sẽ gửi mã đến email đăng kí của bạn trong giây lát!');
        } else {
            return redirect()->route('admin.index')->with('reset_error', 'Email chưa được đăng kí!');
        }
    }
}
