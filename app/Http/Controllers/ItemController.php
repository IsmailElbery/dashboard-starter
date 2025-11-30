<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::latest()->paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'manufacturing_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'status' => 'required|in:active,inactive,pending',
            'category' => 'required|in:electronics,clothing,food,books,other',
            'type' => 'required|in:type_a,type_b,type_c',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'features' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'document' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'color' => 'nullable|string|max:7',
            'url' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        // Handle document upload
        if ($request->hasFile('document')) {
            $validated['document'] = $request->file('document')->store('documents', 'public');
        }

        // Handle checkboxes
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_available'] = $request->has('is_available');

        Item::create($validated);

        return redirect()->route('items.index')
            ->with('success', __('messages.item_created_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'manufacturing_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'status' => 'required|in:active,inactive,pending',
            'category' => 'required|in:electronics,clothing,food,books,other',
            'type' => 'required|in:type_a,type_b,type_c',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'features' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'document' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'color' => 'nullable|string|max:7',
            'url' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        // Handle document upload
        if ($request->hasFile('document')) {
            // Delete old document if exists
            if ($item->document) {
                Storage::disk('public')->delete($item->document);
            }
            $validated['document'] = $request->file('document')->store('documents', 'public');
        }

        // Handle checkboxes
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_available'] = $request->has('is_available');

        $item->update($validated);

        return redirect()->route('items.index')
            ->with('success', __('messages.item_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Delete associated files
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        if ($item->document) {
            Storage::disk('public')->delete($item->document);
        }

        $item->delete();

        return redirect()->route('items.index')
            ->with('success', __('messages.item_deleted_successfully'));
    }
}
