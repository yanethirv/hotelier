<?php

namespace App\Http\Controllers;

use App\Models\ActivationService;
use Illuminate\Http\Request;

class ActivationServiceController extends Controller
{
    public function index(){

        $activationServices = ActivationService::orderBy('type_id', 'asc')->get();

        return view('admin.activation_services.list', compact('activationServices'));

    }
}
