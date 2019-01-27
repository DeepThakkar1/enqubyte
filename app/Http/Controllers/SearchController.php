<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $visitors = auth()->user()->visitors()->where('fname', 'LIKE', '%'.$request->q.'%')->orWhere('lname', 'LIKE', '%'.$request->q.'%')->get();

        $vendors = auth()->user()->vendors()->where('name', 'LIKE', '%'.$request->q.'%')->get();

        $employees = auth()->user()->employees()->where('fname', 'LIKE', '%'.$request->q.'%')->orWhere('lname', 'LIKE', '%'.$request->q.'%')->get();

        $results = $visitors->merge($vendors);

        $results = $results->merge($employees);

        return $results;
    }
}
