<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{

    /**
     * いいねの追加
     * 
     * @param int $item_id
     * @return RedirectResponse 商品詳細画面
     */
    public function store(int $item_id)
    {
        Like::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
        ]);

        return redirect()->back();
    }

    /**
     * いいねの削除
     * 
     * @param int $item_id
     * @return RedirectResponse 商品詳細画面
     */
    public function destroy(int $item_id)
    {
        $like = Like::where('item_id', $item_id)->where('user_id', Auth::id())->first();

        $like->delete();

        return redirect()->back();
    }

}
