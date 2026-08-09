<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::latest()->get();

        return view('backend.owner.index', compact('owners'));
    }

    public function create()
    {
        return view('backend.owner.create');
    }

    public function edit(Owner $owner)
    {
        return view('backend.owner.edit', compact('owner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('owners', 'public');
        }

        Owner::create([
            'name' => $request->name,
            'photo' => $photo,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ]);

        return redirect()->route('admin.owner.index')->with('success', 'Owner added successfully.');
    }

    public function update(Request $request, Owner $owner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('photo')) {
            if ($owner->photo) {
                Storage::disk('public')->delete($owner->photo);
            }
            $owner->photo = $request->file('photo')->store('owners', 'public');
        }

        $owner->name = $request->name;
        $owner->facebook = $request->facebook;
        $owner->instagram = $request->instagram;
        $owner->save();

        return redirect()->route('admin.owner.index')->with('success', 'Owner updated successfully.');
    }

    public function destroy(Owner $owner)
    {
        if ($owner->photo) {
            Storage::disk('public')->delete($owner->photo);
        }
        $owner->delete();

        return response()->json(['success' => true, 'message' => 'Owner deleted successfully.']);
    }

    public function photo(Owner $owner)
    {
        if ($owner->photo && Storage::disk('public')->exists($owner->photo)) {
            return Storage::disk('public')->response($owner->photo);
        }

        $initial = strtoupper(substr($owner->name, 0, 1) ?: '?');
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120">'
            . '<rect width="120" height="120" fill="#eff6ff"/>'
            . '<circle cx="60" cy="60" r="44" fill="#2563eb"/>'
            . '<text x="60" y="74" font-family="Arial, sans-serif" font-size="40" font-weight="bold" fill="#ffffff" text-anchor="middle">' . htmlspecialchars($initial) . '</text>'
            . '</svg>';

        return response($svg, 200, ['Content-Type' => 'image/svg+xml']);
    }
}