<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get statistics for dashboard
        $totalItems = Item::count();
        $activeItems = Item::where('status', 'active')->count();
        $featuredItems = Item::where('is_featured', true)->count();
        $totalValue = Item::sum('price');

        // Get items by category for chart
        $itemsByCategory = Item::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        // Get items by status
        $itemsByStatus = Item::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        return view('home', compact(
            'totalItems',
            'activeItems',
            'featuredItems',
            'totalValue',
            'itemsByCategory',
            'itemsByStatus'
        ));
    }
}
