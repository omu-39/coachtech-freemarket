<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メール認証</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-header />
    <main>
        <form action="{{ route('verification.send') }}" method="post" class="w-[720px] mx-auto text-center mt-[240px]">
            @csrf
            <p class="font-bold text-[24px] mb-[60px]">
                登録していただいたメールアドレスに認証メールを送付しました。<br>
                メール認証を完了してください。
            </p>
            <a href="http://localhost:8025" class="block w-52 px-2 py-2 mx-auto font-bold text-[24px] bg-gray-200 border-black border-[2px] rounded-lg mb-[30px]">
                認証はこちらから
            </a>
            <button type="submit" class="text-[20px] text-blue-600 hover:underline">
                認証メールを再送する
            </button>
        </form>
    </main>
</body>
</html>