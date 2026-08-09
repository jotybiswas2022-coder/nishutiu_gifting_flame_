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

    public function items(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $categoriesQuery = Category::query()
            ->with(['items' => function ($query) {
                $query->with('images')->latest();
            }])
            ->orderBy('name');

        if ($q !== '') {
            $categoriesQuery->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhereHas('items', function ($itemQuery) use ($q) {
                        $itemQuery->where('name', 'like', "%{$q}%")
                            ->orWhere('details', 'like', "%{$q}%");
                    });
            });
        }

        $categories = $categoriesQuery->get();

        if ($q !== '') {
            foreach ($categories as $category) {
                $category->setRelation('items', $category->items->filter(function ($item) use ($q) {
                    $needle = strtolower($q);
                    return strpos(strtolower($item->name), $needle) !== false
                        || ($item->details && strpos(strtolower($item->details), $needle) !== false);
                })->values());
            }
            $categories = $categories->filter(fn ($c) => $c->items->isNotEmpty())->values();
        }

        $categories = $categories->filter(fn ($c) => $c->items->isNotEmpty())->values();

        $totalItems = $categories->sum(fn ($c) => $c->items->count());

        return view('frontend.items', compact('categories', 'totalItems', 'q'));
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