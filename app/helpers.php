<?php

use App\Models\Tax;

function getTaxes()
{
    return auth()->user()->taxes;
}

function getMonths($values)
{
    $labels = [];
    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    foreach ($values as $key => $value) {
        $labels[] = $months[$value-1];
    }

    return $labels;
}
