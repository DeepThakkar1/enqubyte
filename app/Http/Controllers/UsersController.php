<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function emailIsAvailable($email)
    {
        $isAvailable = !User::where('email', $email)->exists();
        if ($isAvailable) {
            return response(['status'=>true], 200);
        }else{
            return response(['status'=>false], 404);
        }
    }

    public function usernameIsAvailable($username)
    {
        $isAvailable = !User::where('company_username', $username)->exists();
        if ($isAvailable) {
            return response(['status'=>true], 200);
        }else{
            return response(['status'=>false], 404);
        }
    }

    public function mode(Request $request)
    {
        auth()->user()->update(['mode' => request('mode'), 'demo'=> 1]);
        return response(['status' => 'success'], 200);
    }
}
