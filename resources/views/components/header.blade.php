<header class="bg-black w-full h-[70px] flex items-center justify-between px-[25px]">
    <div class="w-1/5 flex items-center h-full">
        <img src="/images/COACHTECHヘッダーロゴ.png" alt="COACHTECHロゴ" class="w-full">
    </div>

    @if(!request()->routeIs('login', 'register'))
    <form action="" method="post">
        @csrf

        <div class="w-[600px] bg-white rounded-sm text-[20px] overflow-hidden">
            <input type="text" name="keyword" placeholder="なにをお探しですか？" class="w-full placeholder-black py-2 px-8">
        </div>
    </form>

    <nav class="w-1/5">
        <ul class="flex justify-end space-x-6 text-sm font-medium">
            <li><a href="/logout" class="text-white hover:underline">ログアウト</a></li>
            <li><a href="/mypage" class="text-white hover:underline">マイページ</a></li>
            <li><a href="/sell" class="text-white hover:underline">出品</a></li>
        </ul>
    </nav>
    @endif

</header>