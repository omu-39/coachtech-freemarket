@props(['submit'])

<button type="submit"
    {{ $attributes->merge(['class' => 'w-full text-white bg-[#FF5555] py-[8px] rounded-md text-[24px] font-bold mt-16']) }}>
    {{ $submit }}
</button>