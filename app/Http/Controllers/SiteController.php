<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;

class SiteController extends Controller
{
    public function index(){

        $owners = Owner::latest()->get();

        return view('frontend.index', compact('owners'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
