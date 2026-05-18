@props(['label', 'name', 'type' => 'text', 'placeholder' => '', 'isPrice' => false])

<div class="mb-[30px]">
    <label for="{{ $name }}" class="text-[24px] font-bold">{{ $label }}</label>

    <div class="flex {{ $type === 'textarea' ? 'items-start' : 'items-center' }} border-2 border-[#5F5F5F] rounded-md p-2">

        @if($isPrice)
        <span class="text-[24px] font-bold mr-2 select-none">¥</span>
        @endif

        @if($type === 'textarea')
        @php
            $hasResize = str_contains($attributes->get('class', ''), 'resize');
        @endphp
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'w-full text-[18px] focus:outline-none py-1.5' . ($hasResize ? '' : ' resize-none')]) }}></textarea>
        @else
        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'w-full h-[30px] text-[18px] focus:outline-none']) }}>
        @endif
    </div>

    @error($name)
    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
    @enderror
</div>