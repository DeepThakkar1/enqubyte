<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Lubusin\Mojo\Mojo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rennokki\Plans\Models\PlanModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'company_name' => ['required', 'string'],
            'company_type' => ['required'],
            'company_username' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'strong_password', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $newData = $data;
        $newData['company_email'] = $data['email'];
        $newData['password'] = Hash::make($data['password']);
        return User::create($newData);
    }

     /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
         if(env('APP_ENV') != 'local'){
            $instamojoFormUrl = Mojo::giveMeFormUrl(auth()->user(), 1750, 'Monthly Subscription', '9922367414');
            return redirect($instamojoFormUrl);
        } else {
            $plan = PlanModel::where('name', 'All-in-one monthly')->first();
            $subscription = auth()->user()->subscribeTo($plan, 30); // 30 days
            flash()->overlay('Your payment was successfull! You are subscribed to all-in-one monthly plan and your subscription expires in ' . $subscription->remainingDays() . ' days', 'Account subscription activated');
        }
    }
}
