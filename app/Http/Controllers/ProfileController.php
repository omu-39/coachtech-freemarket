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
     * マイページの表示
     * パラメータによって表示する一覧の切り替え
     * 
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
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

    /**
     * プロフィール編集画面の表示
     * 
     * @return View
     */
    public function show()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    /**
     * プロフィール更新処理
     * 
     * @param ProfileRequest $request
     * @return RedirectResponse マイページ
     */
    public function edit(ProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');

            $user->image = $path;
        }

        $user->update($data);

        return redirect()->route('profile.index');

    }

}
