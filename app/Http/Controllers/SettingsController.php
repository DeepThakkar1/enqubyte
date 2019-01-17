<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportFrequency;

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

    public function updateCompany(Request $request)
    {
        $newData = $request->all();
        if(request()->has('company_logo'))
        {
            $newData['company_logo'] = request()->file('company_logo')->store(
                '/uploads/company/'. auth()->id(), 'public'
            );
        }
        auth()->user()->update($newData);
        flash('Company information has been updated successfully!')->success();
        return back();
    }

    public function reportFrequency(Request $request)
    {
        $newData = $request->all();
        $report = auth()->user()->reportfrequency;
        if ($report) {
            $newData['weekly'] = isset($newData['weekly']) ? 1 : 0;
            $newData['monthly'] = isset($newData['monthly']) ? 1 : 0;
            $newData['quarterly'] = isset($newData['quarterly']) ? 1 : 0;
            $newData['sixmonth'] = isset($newData['sixmonth']) ? 1 : 0;
            $newData['yearly'] = isset($newData['yearly']) ? 1 : 0;
            $report->update($newData);
            flash('Report frequency has been updated successfully!')->success();
        }else{
            auth()->user()->reportfrequency()->create($newData);
            flash('Report frequency has been added successfully!')->success();
        }
        return back();
    }

    public function taxmode(Request $request)
    {
        auth()->user()->update($request->all());
        flash('Tax mode has been changed successfully!')->success();
        return back();
    }
}
