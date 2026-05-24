<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $user = Auth::user();
        $items = Item::query();

        if ($request->page === 'buy') {
            $items->where('buyer_id', $user->id);
        } else {
            $items->where('user_id', $user->id);
        }

        if ($request->keyword) {
            $items->where('name', 'like', '%' . $request->keyword . '%');
        }

        $items = $items->get();

        return view('profile.index', compact('user', 'items', 'request'));
    }

    public function edit(string $id)
    {
        //
    }

}
