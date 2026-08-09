<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerReviewController extends Controller
{
    public function index()
    {
        $reviews = CustomerReview::latest()->get();

        return view('backend.review.index', compact('reviews'));
    }

    public function create()
    {
        return view('backend.review.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $image = $request->file('image')->store('reviews', 'public');

        CustomerReview::create([
            'customer_name' => $request->customer_name,
            'caption' => $request->caption,
            'image' => $image,
        ]);

        return redirect()->route('admin.review.index')->with('success', 'Review image added successfully.');
    }

    public function edit(CustomerReview $review)
    {
        return view('backend.review.edit', compact('review'));
    }

    public function update(Request $request, CustomerReview $review)
    {
        $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($review->image) {
                Storage::disk('public')->delete($review->image);
            }
            $review->image = $request->file('image')->store('reviews', 'public');
        }

        $review->customer_name = $request->customer_name;
        $review->caption = $request->caption;
        $review->save();

        return redirect()->route('admin.review.index')->with('success', 'Review image updated successfully.');
    }

    public function destroy(CustomerReview $review)
    {
        if ($review->image) {
            Storage::disk('public')->delete($review->image);
        }
        $review->delete();

        return response()->json(['success' => true, 'message' => 'Review image deleted successfully.']);
    }

    public function image(CustomerReview $review)
    {
        if ($review->image && Storage::disk('public')->exists($review->image)) {
            return Storage::disk('public')->response($review->image);
        }

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200">'
            . '<rect width="200" height="200" fill="#eff6ff"/>'
            . '<text x="100" y="118" font-family="Arial, sans-serif" font-size="72" text-anchor="middle">📸</text>'
            . '</svg>';

        return response($svg, 200, ['Content-Type' => 'image/svg+xml']);
    }
}