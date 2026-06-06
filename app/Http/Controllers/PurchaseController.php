<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{

    public function index(int $id)
    {
        $item = Item::find($id);
        $user = Auth::user();

        return view('purchase.index', compact('user', 'item'));
    }

    public function store(PurchaseRequest $request, int $item_id)
    {

        $data = $request->validated();
        $item = Item::find($item_id);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => [$data['payment_method']],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => floor($item->price * 1.1),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', ['item_id' => $item_id]),
            'cancel_url' => route('purchase.index', ['item_id' => $item_id]),
        ]);

        session([
            'purchase' => $data,
        ]);

        return redirect($session->url);
    }
    
    public function success(int $item_id)
    {

        $data = session()->pull('purchase');

        Order::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
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
