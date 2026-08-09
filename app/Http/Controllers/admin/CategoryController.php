<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'photo' => $photo,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category added successfully.');
    }

    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            if ($category->photo) {
                Storage::disk('public')->delete($category->photo);
            }
            $category->photo = $request->file('photo')->store('categories', 'public');
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->photo) {
            Storage::disk('public')->delete($category->photo);
        }
        $category->delete();

        return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
    }

    public function photo(Category $category)
    {
        if ($category->photo && Storage::disk('public')->exists($category->photo)) {
            return Storage::disk('public')->response($category->photo);
        }

        $initial = strtoupper(substr($category->name, 0, 1) ?: '?');
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120">'
            . '<rect width="120" height="120" fill="#eff6ff"/>'
            . '<circle cx="60" cy="60" r="44" fill="#2563eb"/>'
            . '<text x="60" y="74" font-family="Arial, sans-serif" font-size="40" font-weight="bold" fill="#ffffff" text-anchor="middle">' . htmlspecialchars($initial) . '</text>'
            . '</svg>';

        return response($svg, 200, ['Content-Type' => 'image/svg+xml']);
    }
}