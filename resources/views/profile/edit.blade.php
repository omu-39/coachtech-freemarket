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

                <x-profile-header user_action="画像を選択する" />

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