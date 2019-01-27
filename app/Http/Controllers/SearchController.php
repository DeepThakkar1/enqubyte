<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return auth()->user()->visitors()->where('fname', 'LIKE', '%'.$request->q.'%')->orWhere('lname', 'LIKE', '%'.$request->q.'%')->get();
    }
}
