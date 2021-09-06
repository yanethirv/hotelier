<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{

    public function pay(Service $service){

        return view('marketplace.services.pay', compact('service'));
        

    }
}
