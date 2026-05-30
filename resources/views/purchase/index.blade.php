<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品購入</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-header />

    <main class="max-w-[1200px] mx-auto p-[40px]">

        <form action="{{ route('purchase.store', ['item_id' => $item->id ]) }}" method="post">
            @csrf

            <div class="grid grid-cols-[1fr_400px] gap-[80px] mt-[50px]">

                <div class="flex flex-col gap-y-8">

                    <div class="flex gap-x-8 pb-8 border-b border-black">
                        <div class="w-[150px] h-[150px] bg-[#D9D9D9] flex items-center justify-center">
                            <img src="{{ $item->image }}" alt="">
                        </div>
                        <div>
                            <h2 class="text-[30px] font-bold mb-2">{{ $item->name }}</h2>
                            <p class="text-[30px]"><span class="text-[27px]">￥</span>{{ floor($item->price * 1.1)}}</p>
                        </div>
                    </div>

                    <div class="pb-8 border-b border-black">
                        <h3 class="text-[20px] font-bold mb-6 ml-8">支払い方法</h3>
                        <div class="w-[250px]">
                            <select
                                id ="payment-select"
                                name ="payment_method"
                                class="w-full h-[30px] border border-gray-500 rounded px-1 text-[16px] bg-white focus:outline-none ml-20">
                                <option value="">選択してください</option>
                                <option value="convenience">コンビニ払い</option>
                                <option value="card">カード払い</option>
                            </select>
                            @error('payment_method')
                                <span class="text-red-500 text-[18px] mt-2 block ml-20">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="pb-8 border-b border-black">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-[20px] font-bold ml-8">配送先</h3>
                            <a href="{{ route('purchase.show', ['item_id' => $item->id]) }}" class="text-[20px] text-blue-600 hover:underline">変更する</a>
                        </div>
                        <div class="text-[20px] leading-relaxed pl-4 ml-20">
                            <p class="font-medium">〒 {{ $user->postal_code }}</p>
                            <p class="mt-1 font-medium">{{ $user->address . $user->build }}</p>
                            @error('shipping_address')
                            <span class="text-red-500 text-[18px] mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <input type="hidden" name="postal_code" value="{{ $user->postal_code }}">
                        <input type="hidden" name="address" value="{{ $user->address }}">
                        <input type="hidden" name="building" value="{{ $user->build }}">

                    </div>

                </div>

                <div class="flex flex-col gap-y-12">

                    <div class="border border-black w-full bg-white">
                        <div class="flex items-center justify-between px-12 py-6 border-b border-black">
                            <span class="text-[20px]">商品代金</span>
                            <span class="text-[24px]">￥{{floor($item->price * 1.1)}}</span>
                        </div>
                        <div class="flex items-center justify-between px-12 py-6">
                            <span class="text-[20px]">支払い方法</span>
                            <span class="text-[24px]" id="payment-display">選択してください</span>
                        </div>

                    </div>

                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <x-form-submit-button submit="購入する" class="mt-2" />

                </div>
            </div>
        </form>
    </main>
</body>

<script>
    const paymentSelect = document.getElementById('payment-select');
    const paymentDisplay = document.getElementById('payment-display');

    paymentSelect.addEventListener('change', function() {
        const selectedText = paymentSelect.options[paymentSelect.selectedIndex].text;
        paymentDisplay.textContent = selectedText;
    });
</script>

</html>