<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display the search page.
     */
    public function index()
    {
        return view('search');
    }

    /**
     * Handle search form submission.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'search_type' => 'required|in:option1,option2,option3',
            'search_query' => 'required|string|max:1000',
        ]);

        // Process the search query here
        // For now, just return success with the data

        return response()->json([
            'success' => true,
            'message' => 'Search submitted successfully!',
            'data' => [
                'search_type' => $validated['search_type'],
                'search_query' => $validated['search_query'],
                'results_count' => rand(1, 10), // Simulated results
            ]
        ]);
    }
}
