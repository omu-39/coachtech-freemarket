@props(['user_action'])

<div class="flex items-center mb-[40px]">
    <!-- 後でimg srcにパラメータを記載する -->
    <!-- <img src="" alt=" プロフィール画像" class="w-[120px] h-[120px] rounded-full mb-[20px]"> -->
    <div class="w-[120px] h-[120px] rounded-full bg-gray-300"></div>

    <label for="profile_image_path" class="cursor-pointer border-2 border-[#FF5555] text-[#FF5555] px-4 py-1 rounded-xl hover:bg-gray-50 text-lg font-medium ml-[30px]">{{ $user_action }}</label>
    <input type="file" id="profile_image_path" name="profile_image_path" accept="image/png, image/jpeg" class="hidden">
</div>