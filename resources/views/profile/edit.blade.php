@extends('layouts.app')

@section('title', 'プロフィール設定')

@section('content')
    <div class="w-[680px] mx-auto mb-[80px]">
        <x-page-heading title="プロフィール設定" />

        <form action="/mypage/profile" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf

            <x-profile-header user_action="画像を選択する" :user="$user" />

            <x-form-input label=" ユーザー名" name="name" type="text" value="{{ $user->name }}" />
            <x-form-input label="郵便番号" name="postal_code" type="text" value="{{ $user->postal_code }}" />
            <x-form-input label="住所" name="address" type="text" value="{{ $user->address }}"/>
            <x-form-input label="建物名" name="building" type="text" value="{{ $user->building }}"/>

            <x-form-submit-button submit="更新する" />
        </form>
    </div>
@endsection

@push('scripts')
<script>
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');
    const dummy = document.getElementById('dummy');

    input.addEventListener('change', function(e) {
        const file = e.target.files[0];

        if(file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');

            if(dummy) {
                dummy.classList.add('hidden');
            }
        }
    });
</script>
@endpush
