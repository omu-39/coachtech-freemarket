<header class="bg-black w-full h-[70px] flex items-center justify-between px-[25px]">
    <div class="w-1/5 flex items-center h-full">
        <a href="/">
            <img src="/images/COACHTECHヘッダーロゴ.png" alt="COACHTECHロゴ" class="w-full">
        </a>
    </div>

    @if(!request()->routeIs('login', 'register'))
    <form action="{{ route('item.index') }}" method="GET">

        <div class="w-[600px] bg-white rounded-sm text-[20px] overflow-hidden">
            <input type="text" name="keyword" placeholder="なにをお探しですか？" class="w-full placeholder-black py-2 px-8">
        </div>
    </form>

    <nav class="w-1/5">
        <ul class="flex justify-end space-x-6 text-[20px] font-medium">
            <li>

                @if (Auth::check())

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-white hover:underline">
                            ログアウト
                        </button>
                    </form>
                @else
                    <a href="/login" class="text-white hover:underline">
                        ログイン
                    </a>
                @endif

            </li>
            <li><a href="{{ route('profile.index') }}" class="text-white hover:underline">マイページ</a></li>
            <li><a href="/sell" class="text-white hover:underline">出品</a></li>
        </ul>
    </nav>
    @endif

</header>