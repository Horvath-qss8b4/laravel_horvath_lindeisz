<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('role')->orderBy('id')->get();

        return view('admin.index', compact('users'));
    }
}
