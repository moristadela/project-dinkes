<?php

// app\Http\Controllers\DashboardController.php

namespace App\Http\Controllers; // <--- Perbaiki baris ini

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller; // Gunakan Controller dasar dari Laravel

class DashboardController extends Controller 
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return view('admin.dashboard');
        }

        return view('dashboard');
    }
}