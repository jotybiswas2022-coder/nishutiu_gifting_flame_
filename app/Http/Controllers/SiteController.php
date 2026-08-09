<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
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

    public function itemsRedirect()
    {
        $category = Category::find(3) ?? Category::has('items')->orderBy('name')->first();

        abort_unless($category, 404);

        return redirect()->route('items.category', $category);
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

        return view('frontend.category', compact('category', 'items', 'categories', 'q'));
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