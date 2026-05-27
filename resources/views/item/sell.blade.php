<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品出品</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-Header />
    <main>
        <div class="w-[680px] mx-auto">

            <x-page-heading title="商品の出品" />

            <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data" class="mb-[120px]">
                @csrf

                <section class="mb-[50px]">

                    <label class="text-[24px] font-bold">商品画像</label>

                    <div class="relative border-2 border-dashed border-[#5F5F5F] rounded-md min-h-[150px] max-h-[300px]">
                        <label id="item_image_label_hidden" for="image" class="cursor-pointer border-2 border-[#FF5555] text-[#FF5555] px-6 py-2 rounded-xl hover:bg-red-50 text-lg font-medium absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 items-center">
                            画像を選択する
                        </label>
                        <input type="file" id="image" name="image" accept="image/*" class="hidden">
                        <div class="w-full h-full align-center">
                            <img id="preview" class="hidden mx-auto max-h-[300px] p-2">
                        </div>
                    </div>
                    <label
                        id="item_image_label_show"
                        for="image"
                        class="cursor-pointer border-2 border-[#FF5555] text-[#FF5555] px-6 py-2 rounded-xl hover:bg-red-50 text-lg font-medium mt-12 block text-center w-[180px] mx-auto hidden">
                        画像を選択する
                    </label>
                    @error('image')
                    <span class="text-red-500 text-[18px] mt-2 block">{{ $message }}</span>
                    @enderror
                </section>

                <section class="mb-[70px]">
                    <div class="mb-[30px]">
                        <h2 class="text-[30px] font-bold pb-[8px] border-b border-[#5F5F5F] text-[#5F5F5F] mb-8">商品の詳細</h2>

                        <h3 class="text-[24px] font-bold mb-7">カテゴリー</h3>

                        <div class="flex flex-wrap gap-4">
                            @foreach ($categories as $category)
                            <label class="cursor-pointer">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="hidden peer">
                                <span class="inline-block px-5 border-2 border-[#FF5555] text-[#FF5555]
                                        rounded-full text-lg font-medium transition duration-200
                                        peer-checked:bg-[#FF5555]
                                        peer-checked:text-white
                                        hover:bg-red-50">
                                    {{ $category->name }}
                                </span>
                            </label>
                            @endforeach
                        </div>

                        @error('categories')
                        <span class="text-red-500 text-[18px] mt-2 block">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <label for="status" class="text-[24px] font-bold">商品の状態</label>
                    <select name="status" id="status" value="{{ old('status') }}" class="cursor-pointer block w-full font-bold text-[#5F5F5F] border-2 border-[#5F5F5F] rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[#B1B1B1] focus:bg-[#636769] focus:bg-b-[#B1B1B1] focus:text-white">
                        <option value="">選択してください</option>
                        <option value="0">良好</option>
                        <option value="1">目立った傷や汚れなし</option>
                        <option value="2">やや傷や汚れあり</option>
                        <option value="3">状態が悪い</option>
                    </select>

                    @error('status')
                    <span class="text-red-500 text-[18px] mt-2 block">
                        {{ $message }}
                    </span>
                    @enderror

                </section>

                <h2 class="text-[30px] font-bold pb-[8px] border-b border-[#5F5F5F] text-[#5F5F5F] mb-8">商品名と説明</h2>
                <x-form-input label="商品名" name="name" />
                <x-form-input label="ブランド名" name="brand_name" />
                <x-form-input type="textarea" label="商品の説明" name="description" class="h-[125px]" />
                <x-form-input label="販売価格" name="price" :isPrice="true" />

                <x-form-submit-button submit="出品する" />
            </form>
        </div>
    </main>

    <script>
        const input = document.getElementById('image');
        const preview = document.getElementById('preview');

        input.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if(file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                item_image_label_hidden.classList.add('hidden');
                item_image_label_show.classList.remove('hidden');
            }
        });
    </script>
</body>

</html>