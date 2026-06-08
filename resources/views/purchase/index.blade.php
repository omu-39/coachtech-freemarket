@extends('layouts.app')

@section('title', '商品購入')

@section('content')
    <div class="max-w-[1200px] mx-auto p-[40px]">
        <form action="{{ route('purchase.store', ['item_id' => $item->id ]) }}" method="post">
            @csrf

            <div class="grid grid-cols-[1fr_400px] gap-[80px] mt-[50px]">

                <div class="flex flex-col gap-y-8">

                    <div class="flex gap-x-8 pb-8 border-b border-black">
                        <div class="w-[150px] h-[150px] bg-[#D9D9D9] flex items-center justify-center">
                            <img src="{{ $item->image_url }}" alt="商品画像">
                        </div>
                        <div>
                            <h2 class="text-[30px] font-bold mb-2">{{ $item->name }}</h2>
                            <p class="text-[30px]"><span class="text-[27px]">￥</span>{{ number_format($item->price_with_tax) }}</p>
                        </div>
                    </div>

                    <div class="pb-8 border-b border-black">
                        <h3 class="text-[20px] font-bold mb-6 ml-8">支払い方法</h3>
                        <div class="w-[250px]">
                            <div class="relative">
                                <select
                                    id ="payment-select"
                                    name ="payment_method"
                                    class="font-bold text-[#5F5F5F] peer appearance-none cursor-pointer w-full h-[30px] border border-gray-500 rounded px-1 text-[16px] bg-white ml-20 focus:outline-none focus-visible:ring ring-gray-400 focus-visible:outline-none focus:bg-[#636769] focus:text-white">
                                    <option value="" disabled selected hidden>選択してください</option>
                                    <option value="konbini">コンビニ払い</option>
                                    <option value="card">カード払い</option>
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-[-70px] flex items-center peer-focus:hidden">
                                    <div
                                        class="border-l-[6px] border-r-[6px] border-t-[12px] border-l-transparent border-r-transparent border-t-[#5F5F5F]">
                                    </div>
                                </div>
                            </div>
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
                            <p class="mt-1 font-medium">{{ $user->address . $user->building }}</p>

                            @if (
                                $message = $errors->first('postal_code')
                                ?: $errors->first('address')
                            )
                                <span class="text-red-500 text-[18px] mt-2 block">
                                    {{ $message }}
                                </span>
                            @endif
                        </div>

                        <input type="hidden" name="postal_code" value="{{ $user->postal_code }}">
                        <input type="hidden" name="address" value="{{ $user->address }}">
                        <input type="hidden" name="building" value="{{ $user->building }}">
                    </div>

                </div>

                <div class="flex flex-col gap-y-12">
                    <div class="border border-black w-full bg-white">
                        <div class="flex items-center justify-between px-12 py-6 border-b border-black">
                            <span class="text-[20px]">商品代金</span>
                            <span class="text-[24px]">￥{{ number_format($item->price_with_tax) }}</span>
                        </div>
                        <div class="flex items-center justify-between px-12 py-6">
                            <span class="text-[20px]">支払い方法</span>
                            <span class="text-[24px]" id="payment-display">選択してください</span>
                        </div>
                    </div>

                    <x-form-submit-button submit="購入する" class="mt-2" />
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    const paymentSelect = document.getElementById('payment-select');
    const paymentDisplay = document.getElementById('payment-display');

    paymentSelect.addEventListener('change', function() {
        const selectedText = paymentSelect.options[paymentSelect.selectedIndex].text;
        paymentDisplay.textContent = selectedText;
    });
</script>
@endpush
