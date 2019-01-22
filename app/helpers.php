<?php

use App\Models\Tax;

function getTaxes()
{
    return auth()->user()->taxes;
}

function getMonths($values)
{
    return  $values;
    $labels = [];
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    foreach ($values as $key => $value) {
        $labels[] = $months[$value-1];
    }

    return $labels;
}



function getDaywiseSales() {
	 $sales = \DB::table('invoices')
	->where('company_id', auth()->id())
    ->select('invoice_date', \DB::raw('sum(grand_total) as total'))
    ->groupBy('invoice_date')
    ->get();

    $data['dates'] = $sales->pluck('invoice_date')->toArray();
    $data['sales'] = $sales->pluck('total')->toArray();
	return $data;
}

function getLastNDays($days, $format = 'd-m-Y'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
    }
    return array_reverse($dateArray);
}

