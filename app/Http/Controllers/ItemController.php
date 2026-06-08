<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\Comment;

class ItemController extends Controller
{
    /**
     * 商品一覧画面の表示
     * パラメータによって表示する一覧の切り替え
     * 
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        if ($request->tab === 'mylist') {

            $items = Auth::check()
                ? auth()->user()->likes()
                : Item::query()->whereRaw('0 = 1');
        } else {
            $items = Item::query();

            if (Auth::check()) {
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

    /**
     * 商品出品画面を表示
     * 
     * @return View
     */
    public function create()
    {
        $categories = Category::all();

        return view('item.sell', compact('categories'));
    }

    /**
     * 商品出品処理
     * カテゴリーは中間テーブルに保存
     * 
     * @param ExhibitionRequest $request 商品出品情報
     * @return RedirectResponse 商品一覧画面
     */
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

    /**
     * 商品詳細画面の表示
     * コメントは最新の１件のみ取得
     * 
     * @param int $item_id
     * @return View
     */
    public function show(int $item_id)
    {
        $comment = Comment::where('item_id', $item_id)->latest()->first();

        $item = Item::find($item_id);
        $categories = $item->categories;
        $user = $comment?->user;

        return view('item.show', compact('item', 'categories', 'user'));
    }

}
