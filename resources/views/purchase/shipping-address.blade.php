@extends('layouts.app')

@section('title', '送り先住所変更')

@section('content')
    <div class="w-[680px] m-auto">
        <form action="" method="POST">
            @csrf
            @method('PATCH')

            <x-page-heading title="住所の変更" />

            <x-form-input label="郵便番号" name="postal_code" value="{{ $user->postal_code }}" />
            <x-form-input label="住所" name="address" value="{{ $user->address }}" />
            <x-form-input label="建物名" name="building" value="{{ $user->build }}"/>

            <x-form-submit-button submit="変更する" class="mt-16" />
        </form>
    </div>
@endsection
