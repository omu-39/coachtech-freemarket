<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-Header />
    <main>
        <div class="w-[680px] mx-auto">
            <x-page-heading title="ログイン" />

            <form action="/login" method="post">
                @csrf
                <x-form-input label="メールアドレス" name="email" type="email" />
                <x-form-input label="パスワード" name="password" type="password" />

                <x-form-submit-button submit="ログイン" />

                <div class="mt-[20px] text-center">
                    <a href="/register" class="text-blue-500 hover:underline">会員登録はこちら</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>