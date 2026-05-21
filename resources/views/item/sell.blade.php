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

            <form action="/products" method="post" enctype="multipart/form-data" class="mb-[120px]">
                @csrf

                <label class="text-[24px] font-bold">商品画像</label>

                <div class="w-full relative border-2 border-dashed border-[#5F5F5F] rounded-md h-[150px] mb-[70px]">
                    <label for="product_image" class="cursor-pointer border-2 border-[#FF5555] text-[#FF5555] px-6 py-2 rounded-xl hover:bg-red-50 text-lg font-medium absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                        画像を選択する
                    </label>
                    <input type="file" id="product_image" name="product_image" accept="image/*" class="hidden">
                </div>

                <section>
                    <h2 class="text-[30px] font-bold pb-[12px] border-b border-[#5F5F5F] text-[#5F5F5F] mb-[36px]">商品の詳細</h2>

                    <h3 class="text-[24px] font-bold">カテゴリー</h3>

                    <div class="flex flex-wrap gap-x-4 gap-y-3 mb-[30px]">
                        <label class="cursor-pointer">
                            <input type="checkbox" name="category-id[]" value="" class="hidden peer">
                            <span class="inline-block px-5 border-2 border-[#FF5555] text-[#FF5555] rounded-full text-lg font-medium transition duration-200
                            peer-checked:bg-[#FF5555] peer-checked:text-white hover:bg-red-50">
                                カテゴリー
                            </span>
                        </label>
                    </div>

                    <label for="product-status" class="text-[24px] font-bold">商品の状態</label>
                    <select name="product-status" id="product-status" class="cursor-pointer block w-full font-bold text-[#5F5F5F] border-2 border-[#5F5F5F] rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-[#B1B1B1] focus:bg-[#636769] focus:bg-b-[#B1B1B1] focus:text-white mb-[70px]">
                        <option value="">選択してください</option>
                        <option value="1">良好</option>
                        <option value="2">目立った傷や汚れなし</option>
                        <option value="3">やや傷や汚れあり</option>
                        <option value="4">状態が悪い</option>
                    </select>
                </section>

                <h2 class="text-[30px] font-bold pb-[12px] border-b border-[#5F5F5F] text-[#5F5F5F] mb-[36px]">商品名と説明</h2>
                <x-form-input label="商品名" name="product-name" />
                <x-form-input label="ブランド名" name="brand-name" />
                <x-form-input type="textarea" label="商品の説明" name="product-description" class="h-[125px]" />
                <x-form-input label="販売価格" name="product-price" :isPrice="true" />

                <x-form-submit-button submit="出品する" />
            </form>
        </div>
    </main>
</body>

</html>