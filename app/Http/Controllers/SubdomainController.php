<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    public function store()
    {
    	 $digitalOcean = new Client([
		        'base_url' => 'https://api.digitalocean.com/v2/',
		        'defaults' => [
		            'auth' => [
		                '7b6c8bdbfa8fcfc3a60c24803a6adae90aa8516172add62244e83b39b38a1cde',
		                ':'
		            ]
		        ]
		    ]);

		    $request = $digitalOcean->post('domains', [
		        'json' => [
		            'name' =>  request('username') . '.enqubyte.com',
		            'ip_address' => '206.189.197.95'
		        ]
		    ]);

		    $domain = $request->json();

		    dd($domain); // just to see result.
    }
}
