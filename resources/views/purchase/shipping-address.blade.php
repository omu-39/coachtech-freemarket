<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>送り先住所変更</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-header />
    <main>
        <div class="w-[680px] m-auto">
            <form action="" method="POST">
                @csrf
                @method('PATCH')

                <x-page-heading title="住所の変更" />

                <x-form-input label="郵便番号" name="postal_code" value="{{ $user->postal_code }}" />
                <x-form-input label="住所" name="address" value="{{ $user->address }}" />
                <x-form-input label="建物名" name="build" value="{{ $user->build }}"/>

                <x-form-submit-button submit="変更する" class="mt-16" />
            </form>
        </div>
    </main>
</body>
</html>