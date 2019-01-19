<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Exports\VisitorsExport;
use Maatwebsite\Excel\Facades\Excel;

class VisitorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'subscribed']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = auth()->user()->stores;
        $visitors = auth()->user()->visitors()->where('is_customer', 0)->where('status', '!=', -1)->get();

        return view('visitors.index', compact('stores', 'visitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newData = $request->all();
        $newData['company_id'] = auth()->id();
        $visitor = auth()->user()->visitors()->create($newData);

        if($request->wantsJson())
        {
            return response($visitor, 200);
        }
        flash('Visitor added successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        return view('visitors.show', compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        $visitor->update($request->all());
        flash('Visitor updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        $visitor->status = -1;
        $visitor->save();
        flash('Visitor deleted successfully!');
        return back();
    }

    public function emailIsAvailable($email)
    {
        $isAvailable = !auth()->user()->visitors()->where('email', $email)->exists();
        if ($isAvailable) {
            return response(['status'=>true], 200);
        }else{
            return response(['status'=>false], 404);
        }
    }

    public function exportToExcel()
    {
        return Excel::download(new VisitorsExport, 'visitors.xlsx');
    }

    public function exportToPDF(){
         return Excel::download(new VisitorsExport(), 'visitors.pdf',  \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function exportToCSV(){
         return Excel::download(new VisitorsExport(), 'visitors.csv',  \Maatwebsite\Excel\Excel::CSV);
    }

}
