<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cours;
use App\Models\Publication;


class AdminDashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard', [
            'usersCount' => User::count(),
            'coursesCount' => Cours::count(),
            'publicationsCount' => Publication::count(),
        ]);
    }
}
