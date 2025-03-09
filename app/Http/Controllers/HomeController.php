<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
