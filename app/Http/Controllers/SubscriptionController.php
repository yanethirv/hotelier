<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index(){

        $property = Auth::user()->properties->first();

        dd($property);

        return view('marketplace.subscriptions.index', compact('property'));

    }
}
