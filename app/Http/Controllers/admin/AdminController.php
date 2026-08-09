<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();

        return view('backend.index', compact('contacts'));
    }

    public function contacts()
    {
        $contacts = Contact::latest()->get();

        return view('backend.contact.index', compact('contacts'));
    }
}