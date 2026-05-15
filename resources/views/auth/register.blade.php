<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-Header />
    <main>
        <div class="w-[680px] mt-[80px] mx-auto">

            <h1 class="text-center font-bold text-[36px] mb-[40px]">会員登録</h1>

            <form action="/register" method="post">
                @csrf
                <div class="mb-[30px]">
                    <label for="name" class="text-[20px] font-bold">ユーザー名</label>
                    <input type="text" id="name" name="name" class="border border-[#5F5F5F] rounded-md w-full h-[50px] px-3 text-[18px]">
                    @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-[30px]">
                    <label for="email" class="text-[20px] font-bold">メールアドレス</label>
                    <input type="email" id="email" name="email" class="border border-[#5F5F5F] rounded-md w-full h-[50px] px-3 text-[18px]">
                    @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-[30px]">
                    <label for="password" class="text-[20px] font-bold">パスワード</label>
                    <input type="password" id="password" name="password" class="border border-[#5F5F5F] rounded-md w-full h-[50px] px-3 text-[18px]">
                    @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-[80px]">
                    <label for="password_confirmation" class="text-[20px] font-bold">確認用パスワード</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="border border-[#5F5F5F] rounded-md w-full h-[50px] px-3 text-[18px]">
                    @error('password_confirmation')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full text-white bg-[#FF5555] py-[10px] rounded-md text-[26px]">登録する</button>
                <div class="mt-[20px] text-center">
                    <a href="/login" class="text-blue-500 hover:underline">ログインはこちら</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>