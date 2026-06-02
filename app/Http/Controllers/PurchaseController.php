<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

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

        $data = $request->validated();

        Order::create([
            'item_id' => $request->item_id,
            'user_id' => $request->user_id,
            'payment_method' => $data['payment_method'],
            'postal_code' => $data['postal_code'],
            'address' => $data['address'],
            'building' => $data['building'],
        ]);

        return redirect()->route('item.index');
    }

    public function show()
    {
        $user = Auth::user();

        return view('purchase.shipping-address', compact('user'));
    }

    public function update(AddressRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        $user->postal_code = $data['postal_code'];
        $user->address = $data['address'];
        $user->building = $data['building'];

        $user->save();

        return redirect()->route('purchase.index', ['item_id' => $request->item_id]);
    }

}
