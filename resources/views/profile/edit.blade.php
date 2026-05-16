<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール設定</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-Header />
    <main>
        <div class="w-[680px] mx-auto">
            <x-page-heading title="プロフィール設定" />

            <form action="/mypage/profile" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf

                <div class="flex items-center mb-[40px]">
                    <!-- 後でimg srcにパラメータを記載する -->
                    <!-- <img src="" alt=" プロフィール画像" class="w-[120px] h-[120px] rounded-full mb-[20px]"> -->
                    <div class="w-[120px] h-[120px] rounded-full bg-gray-300"></div>

                    <label for="profile_image_path" class="cursor-pointer border-2 border-[#FF5555] text-[#FF5555] px-4 py-1 rounded-xl hover:bg-gray-50 text-lg font-medium ml-[30px]">画像を選択する</label>
                    <input type="file" id="profile_image_path" name="profile_image_path" accept="image/png, image/jpeg" class="hidden">
                </div>

                <x-form-input label=" ユーザー名" name="name" type="text" />
                <x-form-input label="郵便番号" name="postal_code" type="text" />
                <x-form-input label="住所" name="address" type="text" />
                <x-form-input label="建物名" name="building_name" type="text" />

                <x-form-submit-button submit="更新する" />
            </form>
        </div>
    </main>
</body>

</html>