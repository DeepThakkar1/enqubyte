<?php

use App\Models\Tax;

function getTaxes()
{
    return Tax::get();
}