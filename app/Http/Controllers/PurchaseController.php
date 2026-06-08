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

    /**
     * 商品購入画面の表示
     * 
     * @param int $item_id
     * @return View
     */
    public function index(int $item_id)
    {
        $item = Item::find($item_id);
        $user = Auth::user();

        return view('purchase.index', compact('user', 'item'));
    }

    /**
     * 商品購入処理
     * Stripe決済セッション作成
     * 
     * @param PurchaseRequest $request 支払方法、配送先情報
     * @param int $item_id
     * @return RedirectResponse Stripeの決済ページ
     */
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
                    'unit_amount' => $item->price_with_tax,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', ['item_id' => $item_id]),
            'cancel_url' => route('purchase.index', ['item_id' => $item_id]),
        ]);

        session([
            'shipping_address' => $data,
        ]);

        return redirect($session->url);
    }
    
    /**
     * 注文情報の保存
     * 
     * @param int $item_id
     * @return RedirectResponse 商品一覧画面
     */
    public function success(int $item_id)
    {

        $data = session()->pull('shipping_address');

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

    /**
     * 配送先変更画面の表示
     * 
     * @return View
     */
    public function show()
    {
        $user = Auth::user();

        return view('purchase.shipping-address', compact('user'));
    }

    /**
     * 配送先変更処理
     * 
     * @param AddressRequest $request
     * @return RedirectResponse 商品購入画面
     */
    public function update(AddressRequest $request)
    {
        $data = $request->validated();

        session([
            'shipping_address' => [
                'postal_code' => $data['postal_code'],
                'address' => $data['address'],
                'building' => $data['building'],
            ]
        ]);

        return redirect()->route('purchase.index', ['item_id' => $request->item_id]);
    }

}
