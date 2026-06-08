@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <div class="w-[680px] mx-auto">
        <x-page-heading title="ログイン" />

        <form action="/login" method="post" novalidate>
            @csrf
            <x-form-input label="メールアドレス" name="email" type="email" />
            <x-form-input label="パスワード" name="password" type="password" />

            <x-form-submit-button submit="ログイン" />

            <div class="mt-[20px] text-center">
                <a href="/register" class="text-blue-500 hover:underline">会員登録はこちら</a>
            </div>
        </form>
    </div>
@endsection
