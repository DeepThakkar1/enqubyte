<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingCotroller extends Controller
{
    public function index(){
    	return view('welcome');
    }
    public function feature(){
    	return view('landing.features');
    }
    public function privacy_policy(){
    	return view('landing.privacy-policy');
    }
    public function terms_services(){
    	return view('landing.terms-services');
    }

    public function demo(){
        return view('landing.demo');
    }

}
