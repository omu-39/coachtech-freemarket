<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    /**
     * 未ログイン時にmylistへアクセスされた場合は空コレクションを返す
     */
    public function index(Request $request)
    {
        if ($request->tab === 'mylist') {

            $items = Auth::check()
                ? auth()->user()->likedItems
                : collect();
        } else {

            $items = Item::all();
        }

        return view('item.index', compact('items', 'request'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('item.sell', compact('categories'));
    }

    public function store(ExhibitionRequest $request)
    {
        $data = $request->validated();

        $categories = $data['categories'];
        unset($data['categories']);

        $path = $request->file('image')->store('images', 'public');

        $data['image'] = $path;
        $data['user_id'] = Auth::id();

        $item = Item::create($data);

        $item->categories()->attach($categories);

        return redirect()->route('item.index');
    }


    public function show(string $id)
    {
        $item = Item::find($id);
        $categories = $item->categories;

        return view('item.show', compact('item', 'categories'));
    }

}
