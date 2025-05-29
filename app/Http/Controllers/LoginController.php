<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function indexLogin()
    {
        return view('auth.login');
    }
    public function proses(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('dashboard.index')->with('success', 'Login Berhasil !');
        }else{
            return redirect()->route('auth.login')->with('failed', 'Email atau Password Salah !');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('success', 'Logout Berhasil !');
    }
    public function Register()
    {
        return view('auth.register');
    }
    public function storeRegister(Request $request)
    // {
    //     dd($request->all());
    // }
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);

        $data ['name'] = $request->name;
        $data ['email'] = $request->email;
        $data ['password'] = Hash::make($request->password);

        User::create($data);

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return redirect()->route('auth.login')->with('success', 'Register Berhasil, Silahkan Login !');
        } else {
            return redirect()->route('auth.login')->with('failed', 'Register Gagal, Silahkan Coba Lagi !');
        }
    }
    
}
