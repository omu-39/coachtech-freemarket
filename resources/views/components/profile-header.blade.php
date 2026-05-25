@props(['user_action', 'user'])

<div class="flex items-center mb-[30px]">

    @if ($user->profile_image)
    <img id="preview" src="{{ asset('storage/' . $user->profile_image) }}" class="w-[120px] h-[120px] rounded-full object-cover">
        @else
        <img id="preview" class="hidden w-[120px] h-[120px] rounded-full object-cover">
        <div id="dummy" class="w-[120px] h-[120px] rounded-full bg-gray-300"></div>
    @endif

    <input type="file" id="image" name="image" accept="image/*" class="hidden">

    <label for="image" class="cursor-pointer border-2 border-[#FF5555] text-[#FF5555] px-4 py-1 rounded-xl hover:bg-red-50 text-lg font-medium ml-[30px]">{{ $user_action }}</label>
</div>