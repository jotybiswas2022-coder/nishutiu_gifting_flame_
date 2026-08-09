<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Owner;

class SiteController extends Controller
{
    public function index(){

        $owners = Owner::latest()->get();

        $latestItems = Item::with('category', 'images')->latest()->take(3)->get();

        return view('frontend.index', compact('owners', 'latestItems'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
