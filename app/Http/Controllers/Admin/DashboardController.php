<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('admin.dashboard', [
            'user' => $user,
            'roles' => $user->roles->pluck('name'),
        ]);
    }
}
