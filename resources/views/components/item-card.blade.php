@props(['item', 'soldItemIds'])

<!-- 後でパスを指定する -->
<div class="w-[290px]">

    <a href="{{ route('item.show', ['id' => $item->id]) }}" class="block">

        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden shadow-sm relative">

            <img src="{{ Str::startsWith($item->image, 'http')
                    ? $item->image
                    : asset('storage/' . $item->image) }}" alt="商品画像" class="w-full h-full object-cover">

            @if (in_array($item->id, $soldItemIds))
                <div class="absolute -left-14 top-2 rotate-[-45deg] bg-red-500 text-white text-center font-bold py-2 w-40 shadow-md">
                    SOLD
                </div>
            @endif

        </div>

        <p class="mt-2 text-gray-900 text-[20px] truncate">
            {{ $item->name }}
        </p>
    </a>
</div>