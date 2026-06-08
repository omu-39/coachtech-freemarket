<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * コメントの保存
     * 
     * @param \App\Http\Requests\CommentRequest $request
     * @param \App\Models\Item $item_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request, int $item_id)
    {
        $comment = $request->validated();
        $item = Item::find($item_id);

        $item->comments()->create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'comment' => $comment['comment']
        ]);

        return redirect()->back();
    }

}
