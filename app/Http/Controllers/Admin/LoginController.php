<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('admin_guest')->except('logout');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if(request('username') =="admin" && request('password')=="admin")
        {
            session(['admin_logged_in' => true]);
            return redirect('/admin/dashboard');
        }
        else{
            flash('Your login credential incorrect, Please enter valid credentials!')->error();
            return back();
        }
    }

    public function logout()
    {
        session(['admin_logged_in' => false]);
        return redirect('/admin');
    }
}
