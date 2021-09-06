<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(){

        $resources = Resource::paginate(500);

        return view('admin.resources.index', compact('resources'));

    }
}
