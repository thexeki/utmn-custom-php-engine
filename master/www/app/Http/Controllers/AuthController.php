<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Форма авторизации
    public function showLoginForm()
    {
        return view('forms.login');
    }

    // Авторизация
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('cabinet'); // Перенаправление в личный кабинет
        }

        return back()->withErrors(['email' => 'Неверные учетные данные.']);
    }

    // Форма регистрации
    public function showRegisterForm()
    {
        return view('forms.reg');
    }

    // Регистрация
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'visitor'; // По умолчанию роль "Посетитель"

        User::create($data);

        return redirect()->route('login.form')->with('success', 'Регистрация успешна!');
    }

    // Выход из системы
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
