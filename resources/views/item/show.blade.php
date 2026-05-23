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
                <img src="{{ Str::startsWith($item->image, 'http')
                    ? $item->image
                    : asset('storage/' . $item->image) }}" alt="商品画像"
                    class="w-full h-full object-cover rounded-lg">
            </div>

            <div class="w-[690px] mr-auto px-[50px]">
                <h1 class="text-[45px] font-bold mb-[10px]">{{ $item->name }}</h1>
                <p class="text-[18px] mb-[28px]">{{ $item->brand }}</p>
                <p class="text-[25px]">
                    ￥
                    <span class="mr-[8px] text-[45px]">{{ floor($item->price * 1.1) }}</span>
                    (税込み)
                </p>
                <div class="flex ml-[42px] mt-[28px]">
                    <div class="w-[40px] text-center">

                        @if ($item->isLiked())
                            <form action="{{ route('like.destroy', ['item_id' => $item->id]) }}" method="post">
                                @csrf
                                <button>
                                    <img src="/images/ハートロゴ_ピンク.png" alt="イイネ" class="w-full">
                                </button>
                            </form>
                            <span class="text-[18px]">{{ $item->likes->count() }}</span>
                            @else
                                <form action="{{ route('like.store', ['item_id' => $item->id]) }}" method="post">
                                    @csrf
                                    <button>
                                        <img src="/images/ハートロゴ_デフォルト.png" alt="イイネ" class="w-full">
                                    </button>
                                </form>
                            <span class="text-[18px]">{{ $item->likes->count() }}</span>
                        @endif

                    </div>
                    <div class="ml-[62px] w-[38px] text-center">
                        <img src="/images/ふきだしロゴ.png" alt="コメント" class="w-full">
                        <span class="text-[18px]">{{ $item->comments->count() }}</span>
                    </div>
                </div>

                <a href=""
                    class="w-full text-white bg-[#FF5555] py-[8px] rounded-md text-[24px] font-bold block text-center mt-[22px] mb-[50px]">
                    購入手続きへ
                </a>

                <section class="mb-[50px]">
                    <h2 class="text-[36px] font-bold mb-[20px]">商品説明</h2>

                    <div class="text-[18px] text-gray-700 font-medium leading-relaxed">
                        {!! nl2br(e($item->description)) !!}
                    </div>

                </section>

                <section class="mb-[50px]">
                    <h2 class="text-[36px] font-bold mb-[20px]">商品の情報</h2>
                    <div class="grid grid-cols-[150px_1fr] gap-y-4 items-center">

                        <span class="text-[24px] font-bold text-gray-950">カテゴリー</span>

                        <div class="flex items-center gap-2">
                            @foreach ($categories as $category)
                            <span class="bg-[#D9D9D9] text-[20px] text-gray-850 px-6 py-1 rounded-full">{{$category->name}}</span>
                            @endforeach
                        </div>

                        <span class="text-[24px] font-bold text-gray-950">商品の状態</span>
                        <span class="text-[20px] text-gray-950 ml-[20px]">{{ $item->getStatusLabelAttribute() }}</span>

                    </div>
                </section>

                <form action="" method="post">
                    @csrf

                    <h3 class="text-[36px] font-bold mb-[30px] text-[#5F5F5F]">コメント</h3>
                    <div class="flex items-center mb-[20px]">
                        <div class="w-[70px] aspect-square bg-[#D9D9D9] rounded-full"></div>
                        <p class="ml-[30px] text-[30px] font-bold">{{ $item->user->name }}</p>
                    </div>
                    <p class="bg-[#E5E5E5] items-center p-[15px] text-[20px] rounded-lg mb-[30px]">{{ $item->comment }}</p>

                    <x-form-input type="textarea" label="商品へのコメント" name="comment" class="h-[250px] resize" />

                    <x-form-submit-button submit="コメントを送信する" class="mt-2" />
                </form>
            </div>
        </div>
    </main>
</body>

</html>