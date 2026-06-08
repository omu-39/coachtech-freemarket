@extends('layouts.app')

@section('title', '会員登録')

@section('content')
    <div class="w-[680px] mx-auto">
        <x-page-heading title="会員登録" />

        <form action="/register" method="post" novalidate>
            @csrf
            <x-form-input label="ユーザー名" name="name" />
            <x-form-input label="メールアドレス" name="email" type="email" />
            <x-form-input label="パスワード" name="password" type="password" />
            <x-form-input label="確認用パスワード" name="password_confirmation" type="password" />

            <x-form-submit-button submit="登録する" />

            <div class="mt-[20px] text-center">
                <a href="/login" class="text-blue-500 hover:underline">ログインはこちら</a>
            </div>
        </form>
    </div>
@endsection
