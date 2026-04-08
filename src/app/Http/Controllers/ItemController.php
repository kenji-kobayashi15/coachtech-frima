<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where('user_id', '!=', Auth::id())->get();
        return view('items.index', compact('items'));
    }

    public function show($id)
    {
        $item = Item::with(['comments', 'likes'])->findOrFail($id);
        return view('items.show', compact('item'));
    }
}
