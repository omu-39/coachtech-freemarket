<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品一覧</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-Header />
    <main>
        <nav class="pl-[200px] pb-2 flex space-x-8 border-b-2 border-[#5F5F5F] mt-11">
            @if ($request->tab === 'mylist')
                <a href="{{ route('item.index', ['keyword' => request('keyword')]) }}" class="font-bold text-lg">おすすめ</a>
                <a href="{{ route('item.index', ['tab' => 'mylist', 'keyword' => request('keyword')]) }}" class="text-red-500 font-bold text-lg">マイリスト</a>
            @else
                <a href="{{ route('item.index', ['keyword' => request('keyword')]) }}" class="text-red-500 font-bold text-lg">おすすめ</a>
                <a href="{{ route('item.index', ['tab' => 'mylist', 'keyword' => request('keyword')]) }}" class="font-bold text-lg">マイリスト</a>
            @endif
        </nav>

        <div class="max-w-[1540px] mx-auto my-[30px] px-[50px]">
            <div class="grid grid-cols-4 gap-6">

                @foreach ($items as $item)
                    <x-item-card :item="$item" :sold-item-ids="$soldItemIds" />
                @endforeach

            </div>
        </div>
    </main>
</body>
</html>