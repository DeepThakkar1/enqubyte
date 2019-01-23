<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin_login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersCnt = User::count();
        $users = User::orderBy('created_at', 'desc')->limit(5)->get();
        $subscribers = User::orderBy('created_at', 'desc')->limit(5)->get();
        return view('admin.dashboard.index', compact('usersCnt', 'users', 'subscribers'));
    }
}
