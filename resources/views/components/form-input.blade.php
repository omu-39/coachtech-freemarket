@props(['label', 'name', 'type' => 'text', 'placeholder' => '', 'isPrice' => false])

<div class="mb-[30px]">
    <label for="{{ $name }}" class="text-[24px] font-bold">{{ $label }}</label>

    <div {{ $attributes->merge(['class' => 'flex border border-[#5F5F5F] rounded-md w-full h-[38px] px-3 bg-white']) }}>

        @if($isPrice)
        <span class="text-[18px] font-bold text-[#5F5F5F] mr-2 select-none">¥</span>
        @endif

        @if($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            class="w-full h-full text-[18px] bg-transparent focus:outline-none py-1.5 resize-none"></textarea>
        @else
        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            class="w-full h-full text-[18px] bg-transparent focus:outline-none p-0">
        @endif
    </div>

    @error($name)
    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
    @enderror
</div>