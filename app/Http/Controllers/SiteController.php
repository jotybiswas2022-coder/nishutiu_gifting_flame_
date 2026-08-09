<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Models\CustomerReview;
use App\Models\Item;
use App\Models\Owner;
use App\Models\Setting;

class SiteController extends Controller
{
    public function index(){

        $owners = Owner::latest()->get();

        $latestItems = Item::with('category', 'images')->latest()->take(3)->get();

        $customerReviews = CustomerReview::latest()->take(8)->get();

        return view('frontend.index', compact('owners', 'latestItems', 'customerReviews'));
    }

    public function contact()
    {
        $settings = [
            'gmail' => Setting::get('gmail'),
            'whatsapp' => Setting::get('whatsapp_number'),
            'facebook' => Setting::get('facebook_page'),
            'instagram' => Setting::get('instagram_page'),
        ];

        return view('frontend.contact', compact('settings'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Your message was sent successfully!']);
        }

        return redirect()->route('contact.page')->with('success', 'Your message was sent successfully!');
    }

    public function items(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $itemsQuery = Item::with('category', 'images')->latest();

        if ($q !== '') {
            $itemsQuery->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('details', 'like', "%{$q}%");
            });
        }

        $items = $itemsQuery->get();

        $categories = Category::has('items')->withCount('items')->orderBy('name')->get();

        $totalItems = $items->count();

        return view('frontend.items', compact('items', 'categories', 'totalItems', 'q'));
    }

    public function categoryItems(Request $request, Category $category)
    {
        $q = trim((string) $request->query('q', ''));

        $itemsQuery = $category->items()->with('images')->latest();

        if ($q !== '') {
            $itemsQuery->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('details', 'like', "%{$q}%");
            });
        }

        $items = $itemsQuery->get();

        $categories = Category::has('items')->withCount('items')->orderBy('name')->get();

        $totalItems = Item::count();

        return view('frontend.category', compact('category', 'items', 'categories', 'totalItems', 'q'));
    }

    public function show(Item $item)
    {
        $item->load('category', 'images');

        $related = Item::with('images')
            ->where('category_id', $item->category_id)
            ->where('id', '!=', $item->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.item', compact('item', 'related'));
    }
}