<?php include './views/components/header-dashboard.php'; ?>

<div class="flex justify-center h-screen">
    <div class="overflow-x-auto bg-white shadow-md rounded-lg py-10 px-20 w-screen">
        <div class="flex justify-between my-5">
            <h1 class="text-xl">Tambah Data Barang</h1>
        </div>
        <form action="/uasweb/?page=dashboard-add-product" method="POST">
            <div class="col-span-full py-2">
                <label for="product_name" class="block text-sm/6 font-medium text-gray-900">Nama Produk</label>
                <div class="mt-2">
                    <input type="text" name="product_name" id="product_name" autocomplete="street-address" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="col-span-full py-2">
                <label for="description" class="block text-sm/6 font-medium text-gray-900">Deskripsi Produk</label>
                <div class="mt-2">
                    <input type="text" name="description" id="description" autocomplete="street-address" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="col-span-full py-2">
                <label for="price" class="block text-sm/6 font-medium text-gray-900">Harga Produk</label>
                <div class="mt-2">
                    <input type="text" name="price" id="price" autocomplete="street-address" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="col-span-full py-2">
                <label for="stock" class="block text-sm/6 font-medium text-gray-900">Stok Produk</label>
                <div class="mt-2">
                    <input type="text" name="stock" id="stock" autocomplete="street-address" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="col-span-full py-2">
                <label for="category" class="block text-sm/6 font-medium text-gray-900">Kategori Produk</label>
                <div class="mt-2">
                    <input type="text" name="category" id="category" autocomplete="street-address" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="col-span-full py-2">
                <label for="image_URL" class="block text-sm/6 font-medium text-gray-900">Url Gambar Produk</label>
                <div class="mt-2">
                    <input type="text" name="image_URL" id="image_URL" autocomplete="street-address" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div class="flex justify-end py-5">
                <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Barang</button>
            </div>
        </form>
    </div>
</div>

<?php include './views/components/footer.php'; ?>