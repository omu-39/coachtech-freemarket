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
        <div class="grid grid-cols-[1fr_400px] gap-[80px] mt-[50px]">

            <div class="flex flex-col gap-y-8">

                <div class="flex gap-x-8 pb-8 border-b border-black">
                    <div class="w-[150px] h-[150px] bg-[#D9D9D9] flex items-center justify-center">
                    </div>
                    <div>
                        <h2 class="text-[30px] font-bold mb-2">商品名</h2>
                        <p class="text-[30px]"><span class="text-[27px]">￥</span>47,000</p>
                    </div>
                </div>

                <div class="pb-8 border-b border-black">
                    <h3 class="text-[20px] font-bold mb-6 ml-8">支払い方法</h3>
                    <div class="w-[250px]">
                        <select
                            class="w-full h-[30px] border border-gray-500 rounded px-1 text-[16px] bg-white focus:outline-none ml-20">
                            <option value="">選択してください</option>
                            <option value="convenience">コンビニ払い</option>
                            <option value="card">クレジットカード</option>
                        </select>
                    </div>
                </div>

                <div class="pb-8 border-b border-black">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-[20px] font-bold ml-8">配送先</h3>
                        <a href="#" class="text-[20px] text-blue-600 hover:underline">変更する</a>
                    </div>
                    <div class="text-[20px] leading-relaxed pl-4 ml-20">
                        <p class="font-medium">〒 XXX-YYYY</p>
                        <p class="mt-1 font-medium">ここには住所と建物が入ります</p>
                    </div>
                </div>

            </div>

            <div class="flex flex-col gap-y-12">

                <div class="border border-black w-full bg-white">
                    <div class="flex items-center justify-between px-12 py-6 border-b border-black">
                        <span class="text-[20px]">商品代金</span>
                        <span class="text-[24px]">¥ 47,000</span>
                    </div>
                    <div class="flex items-center justify-between px-12 py-6">
                        <span class="text-[20px]">支払い方法</span>
                        <span class="text-[24px]">コンビニ払い</span>
                    </div>
                </div>

                <x-form-submit-button submit="購入する"></x-form-submit-button>

            </div>

        </div>
    </main>
</body>

</html>