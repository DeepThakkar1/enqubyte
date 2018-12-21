<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index');
    }

    public function changeMode(Request $request)
    {
        auth()->user()->update($request->all());
        flash('Your have activeated multistore store mode.');
        return back();
    }

    public function updateProfile(Request $request)
    {
        $newData = $request->all();
        if(auth()->user()->email == request('email')){
            auth()->user()->update($newData);
        }else{
            // $newData['email_verified_at'] = null;
            auth()->user()->update($newData);
        }
        flash('Your profile information was updated successfully.')->success();
        return back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|string|min:8|strong_password|confirmed'
        ]);

        $old_password = $request->get('old_password');
        $password = $request->get('password');

        if(!\Hash::check($old_password, auth()->user()->password))
        {
            flash('Your old password is incorrect!')->error();
            return back();
        }

        auth()->user()->password = bcrypt($password);
        auth()->user()->save();

        flash('Your password was successfully updated!')->success();

        return back();
    }

}
