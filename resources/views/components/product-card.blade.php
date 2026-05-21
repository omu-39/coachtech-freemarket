@props(['item'])

<!-- 後でパスを指定する -->
<a href="#" class="block">
    <div class="aspect-square w-[290px] bg-gray-200 rounded-lg overflow-hidden shadow-sm">
        <img src="{{ $item->image }}" alt="商品画像" class="w-full h-full object-cover">
    </div>
    <p class="mt-2 text-gray-900 text-[20px] truncate">{{ $item->name  }}</p>
</a>