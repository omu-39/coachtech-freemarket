<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-header />
    <main class="w-full">
        <div class="w-full grid md:grid-cols-2 my-[40px]">
            <div class="w-[690px] aspect-square ml-auto p-[40px]">
                <div class="bg-gray-300 rounded-xl w-full h-full"></div>
                {{-- <img src="" alt="商品写真" class="w-full h-full object-cover> --}}
            </div>

            <div class="w-[690px] mr-auto px-[50px]">
                <h1 class="text-[45px] font-bold mb-[10px]">商品名がここに入る</h1>
                <p class="text-[18px] mb-[28px]">ブランド名</p>
                <p class="text-[30px]">
                    <span class="mr-[4px] text-[40px]">¥9,800</span>
                    (税込み)
                </p>
                <div class="flex ml-[42px] mt-[28px]">
                    <div class="w-[40px] text-center">
                        <img src="/images/ハートロゴ_デフォルト.png" alt="イイネ" class="w-full">
                        <span class="text-[18px]">3</span>
                    </div>
                    <div class="ml-[62px] w-[38px] text-center">
                        <img src="/images/ふきだしロゴ.png" alt="コメント" class="w-full">
                        <span class="text-[18px]">3</span>
                    </div>
                </div>

                <a href=""
                    class="w-full text-white bg-[#FF5555] py-[8px] rounded-md text-[24px] font-bold block text-center mt-[22px] mb-[50px]">
                    購入手続きへ
                </a>

                <section class="mb-[50px]">
                    <h2 class="text-[36px] font-bold mb-[20px]">商品説明</h2>
                    {{-- 下記はコントローラー作成時に有効にして仮置きしている文章は削除する --}}
                    {{-- <div class="text-[18px] text-gray-700 font-medium leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div> --}}
                    <div class="text-[24px]">
                        <p>カラー：グレー</p>
                        <br>
                        <p>新品</p>
                        <p>商品の状態は良好です。傷もありません</p>
                        <br>
                        <p>購入後、即発送いたします。</p>
                    </div>
                </section>

                <section class="mb-[50px]">
                    <h2 class="text-[36px] font-bold mb-[20px]">商品の情報</h2>
                    <div class="grid grid-cols-[150px_1fr] gap-y-4 items-center">

                        <span class="text-[24px] font-bold text-gray-950">カテゴリー</span>

                        <div class="flex items-center gap-2">
                            <span class="bg-[#D9D9D9] text-[20px] text-gray-850 px-6 py-1 rounded-full">洋服</span>
                            <span class="bg-[#D9D9D9] text-[20px] text-gray-850 px-6 py-1 rounded-full">メンズ</span>
                        </div>

                        <span class="text-[24px] font-bold text-gray-950">商品の状態</span>
                        <span class="text-[20px] text-gray-950 ml-[20px]">良好</span>

                    </div>
                </section>

                <form action="" method="post">
                    <h3 class="text-[36px] font-bold mb-[30px] text-[#5F5F5F]">コメント</h3>
                    <div class="flex items-center mb-[20px]">
                        <div class="w-[70px] aspect-square bg-[#D9D9D9] rounded-full"></div>
                        <p class="ml-[30px] text-[30px] font-bold">admin</p>
                    </div>
                    <p class="bg-[#E5E5E5] items-center p-[15px] text-[20px] rounded-lg mb-[30px]">こちらにコメントが入ります。</p>

                    <x-form-input type="textarea" label="商品へのコメント" name="comment" class="h-[250px] resize" />

                    <x-form-submit-button submit="コメントを送信する" />
                </form>
            </div>
        </div>
    </main>
</body>

</html>