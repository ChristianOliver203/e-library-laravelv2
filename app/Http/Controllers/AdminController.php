<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $adminUsername = 'admin';
        $adminPassword = '12345';

        if ($request->username === $adminUsername && $request->password === $adminPassword) {
            $request->session()->put('is_admin', true);
            return redirect()->route('book.list')->with('success','Welcome Admin!');
        }

        return back()->with('error','Invalid credentials!');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        return redirect()->route('home')->with('success','Logged out successfully!');
    }
}
