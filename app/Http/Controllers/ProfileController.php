<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Http\Requests\ProfileRequest;
use App\Models\Order;

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

            $itemIds = Order::where('user_id', $user->id)->pluck('item_id')->toArray();
            $items->whereIn('id', $itemIds);

        } else {

            $items->where('user_id', $user->id);

        }

        if ($request->keyword) {
            $items->where('name', 'like', '%' . $request->keyword . '%');
        }

        $items = $items->get();
        $soldItemIds = Order::pluck('item_id')->toArray();

        return view('profile.index', compact('user', 'items', 'request', 'soldItemIds'));
    }

    public function show()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));

    }

    public function edit(ProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');

            $user->profile_image = $path;
        }

        $user->update($data);

        return redirect()->route('profile.index');

    }

}
