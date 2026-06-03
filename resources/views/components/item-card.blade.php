@props(['item', 'soldItemIds'])

<div class="w-[290px]">

    <a href="{{ route('item.show', ['item_id' => $item->id]) }}" class="block">

        <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden shadow-sm relative">

            <img src="{{ Str::startsWith($item->image, 'http')
                    ? $item->image
                    : asset('storage/' . $item->image) }}" alt="商品画像" class="w-full h-full object-cover">

            @if (in_array($item->id, $soldItemIds))
                <div data-testid="sold-item-{{ $item->id }}" class="absolute top-5 -left-10 rotate-[-45deg] bg-red-600 text-white w-[160px] text-center py-2 font-bold text-[20px] shadow-lg">
                    Sold
                </div>
            @endif
        </div>

        <p class="mt-2 text-gray-900 text-[20px] truncate">
            {{ $item->name }}
        </p>
    </a>
</div>