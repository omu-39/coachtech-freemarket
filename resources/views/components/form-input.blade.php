@props(['label', 'name', 'type' => 'text', 'placeholder' => ''])

<div class="mb-[30px]">
    <label for="{{ $name }}" class="text-[20px] font-bold">{{ $label }}</label>

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        class="border border-[#5F5F5F] rounded-md w-full h-[50px] px-3 text-[18px]"
    >

    @error($name)
    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
    @enderror
</div>