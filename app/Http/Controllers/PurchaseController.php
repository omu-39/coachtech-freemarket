<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class PurchaseController extends Controller
{

    public function index(int $id)
    {
        $item = Item::find($id);
        $user = Auth::user();

        return view('purchase.index', compact('user', 'item'));
    }


    public function store(PurchaseRequest $request)
    {
        $item = Item::find($request->item_id);

        if ($item->buyer_id){
            return back();
        }

        $item->buyer_id = Auth::id();

        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}
