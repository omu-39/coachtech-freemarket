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
        <div class="w-[680px] mt-[80px] mx-auto">
            <h1 class="text-center font-bold text-[36px] mb-[40px]">プロフィール設定</h1>

            <form action="/mypage/profile" method="post">
                @method('patch')
                @csrf
                
            </form>
        </div>
    </main>
</body>

</html>