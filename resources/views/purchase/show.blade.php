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
        <div class="w-[1380px] grid md:grid-cols-2 mt-[40px] mb-[40px]">
            <div class="w-[600px] aspect-square bg-black">
                {{-- <img src="" alt=""> --}}
            </div>

            <div class="w-full">
                <h1 class="text-[30px] font-bold mb-[20px]">商品名がここに入る</h1>
                <p class="text-[18px] text-[#5F5F5F] mb-[40px]">ブランド名</p>
                <p class="text-[30px] font-bold">¥9,800</p>
                <div class="flex">
                    <div class="w-[40px]">
                        <img src="/images/ハートロゴ_デフォルト.png" alt="イイネ" class="w-full">
                        <span>3</span>
                    </div>
                    <div class="ml-[40px] w-[38px]">
                        <img src="/images/ふきだしロゴ.png" alt="コメント" class="w-full">
                        <span>3</span>
                    </div>
                </div>

                <a href="" class="w-full text-white bg-[#FF5555] py-[8px] rounded-md text-[24px] font-bold block text-center">購入手続きへ</a>

                <section>
                    <h2>商品説明</h2>
                    <p>カラー：グレー</p>
                    <p>新品</p>
                    <p>商品の状態は良好です。傷もありません。</p>
                    <p>購入後、即発送いたします。</p>
                </section>

                <section>
                    <h2>商品の情報</h2>
                    <p>カテゴリー</p>
                    <p>商品の状態</p>
                </section>

                    <form action="">
                        <h3>コメント</h3>
                        <div class="flex">
                            <div class="w-[70px] bg-[#D9D9D9]"></div>
                            <p>admin</p>
                        </div>
                        <p>こちらにコメントが入ります。</p>

                        <h3>商品へのコメント</h3>
                    </div>
            </div>
        </div>
    </main>
</body>
</html>