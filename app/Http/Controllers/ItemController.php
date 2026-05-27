<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ItemController extends Controller
{
    /**
     * 未ログイン時にmylistへアクセスされた場合は空コレクションを返す
     */
    public function index(Request $request)
    {
        if ($request->tab === 'mylist') {

            $items = Auth::check()
                ? auth()->user()->likes()
                : Item::query()->whereRaw('0 = 1');
        } else {

            $items = Item::query();

            if(Auth::check()) {
                $items->where('user_id', '!=', Auth::id());
            }
        }

        if ($request->keyword) {
            $items->where('name', 'like', '%' . $request->keyword . '%');
        }

        $items = $items->get();
        $soldItemIds = Order::pluck('item_id')->toArray();

        return view('item.index', compact('items', 'request', 'soldItemIds'));
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


    public function show(int $id)
    {
        $item = Item::find($id);
        $categories = $item->categories;
        $user = Auth::user();

        return view('item.show', compact('item', 'categories', 'user'));
    }

}
