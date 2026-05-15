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
        <div class="w-[680px] mt-[80px] mx-auto">
            <h1 class="text-center font-bold text-[36px] mb-[40px]">ログイン</h1>
            <form action="/login" method="post">
                @csrf
                <x-form-input label="メールアドレス" name="email" type="email" />
                <x-form-input label="パスワード" name="password" type="password" />

                <button type="submit" class="w-full text-white bg-[#FF5555] py-[10px] rounded-md text-[24px] font-bold mt-[50px]">ログインする</button>

                <div class="mt-[20px] text-center">
                    <a href="/register" class="text-blue-500 hover:underline">会員登録はこちら</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>