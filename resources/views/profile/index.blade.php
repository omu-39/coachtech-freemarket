<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-Header />
    <main>
        <div class="w-[900px] m-auto my-[50px] flex items-center justify-between">
            @if ($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" class="w-[120px] h-[120px] rounded-full object-cover">
            @else
                <div class="w-[120px] h-[120px] rounded-full bg-gray-300"></div>
            @endif

            <h2 class="text-2xl font-bold ml-[30px] mr-[300px]">{{ $user->name }}</h2>

            <a href="{{ route('profile.show') }}" class="cursor-pointer border-2 border-[#FF5555] text-[#FF5555] px-8 py-1 rounded-xl hover:bg-gray-50 text-lg font-medium ml-[30px]">プロフィールを編集</a>
        </div>

        <nav class="pl-[200px] pb-2 flex space-x-8 border-b-2 border-[#5F5F5F]">
            @if ($request->page === 'buy')
                <a href="{{ route('profile.index', ['page' => 'sell']) }}" class="font-bold text-lg">出品した商品</a>
                <a href="{{ route('profile.index', ['page' => 'buy']) }}" class="text-red-500 font-bold text-lg">購入した商品</a>
            @else
                <a href="{{ route('profile.index', ['page' => 'sell']) }}" class="text-red-500 font-bold text-lg">出品した商品</a>
                <a href="{{ route('profile.index', ['page' => 'buy']) }}" class="font-bold text-lg">購入した商品</a>
            @endif
        </nav>

        <div class="max-w-[1540px] mx-auto my-[30px] px-[50px]">
            <div class="grid grid-cols-4 gap-6">

                @foreach ($items as $item)
                    <x-item-card :item="$item" :soldItemIds="$soldItemIds" />
                @endforeach

            </div>
        </div>
    </main>
</body>
</html>