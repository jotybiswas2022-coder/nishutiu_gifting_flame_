<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category', 'images')->withCount('images')->latest()->get();

        return view('backend.item.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('backend.item.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'details' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $item = Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'cost' => $request->cost,
            'details' => $request->details,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('items', 'public');
                $item->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.item.index')->with('success', 'Item added successfully.');
    }

    public function edit(Item $item)
    {
        $item->load('images');
        $categories = Category::orderBy('name')->get();

        return view('backend.item.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'details' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'integer',
        ]);

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'cost' => $request->cost,
            'details' => $request->details,
        ]);

        if ($request->filled('remove_images')) {
            $toRemove = ItemImage::where('item_id', $item->id)->whereIn('id', $request->remove_images)->get();
            foreach ($toRemove as $img) {
                Storage::disk('public')->delete($img->image);
                $img->delete();
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('items', 'public');
                $item->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.item.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        foreach ($item->images as $img) {
            Storage::disk('public')->delete($img->image);
        }
        $item->delete();

        return response()->json(['success' => true, 'message' => 'Item deleted successfully.']);
    }

    public function image(ItemImage $itemImage)
    {
        if (Storage::disk('public')->exists($itemImage->image)) {
            return Storage::disk('public')->response($itemImage->image);
        }

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120">'
            . '<rect width="120" height="120" fill="#eff6ff"/>'
            . '<circle cx="60" cy="60" r="44" fill="#2563eb"/>'
            . '<text x="60" y="74" font-family="Arial, sans-serif" font-size="40" font-weight="bold" fill="#ffffff" text-anchor="middle">?</text>'
            . '</svg>';

        return response($svg, 200, ['Content-Type' => 'image/svg+xml']);
    }
}