@props(['item'])

<!-- 後でパスを指定する -->
<div class="w-[290px]">

    <a href="{{ route('item.show', ['id' => $item->id]) }}" class="block">

        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden shadow-sm">

            <img src="{{ Str::startsWith($item->image, 'http')
                    ? $item->image
                    : asset('storage/' . $item->image) }}" alt="商品画像" class="w-full h-full object-cover">

        </div>

        <p class="mt-2 text-gray-900 text-[20px] truncate">
            {{ $item->name }}
        </p>
    </a>
</div>