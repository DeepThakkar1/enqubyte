<?php

use App\Models\Tax;

function getTaxes()
{
    return auth()->user()->taxes;
}

