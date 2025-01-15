<?php include './views/components/header-dashboard.php'; ?>

<div class="flex justify-center h-screen">
    <div class="overflow-x-auto bg-white rounded-lg p-10">
        <div class="flex justify-between my-5">
            <h1 class="text-xl">Data Barang</h1>
            <a href="/uasweb?page=dashboard-add-product" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Barang</a>
        </div>
        <table class="min-w-full table-auto">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">Nama Produk</th>
                    <th class="px-6 py-3 text-left">Deskripsi</th>
                    <th class="px-6 py-3 text-left">Harga</th>
                    <th class="px-6 py-3 text-left">Stok</th>
                    <th class="px-6 py-3 text-left">Kategori</th>
                    <th class="px-6 py-3 text-left">Gambar</th>
                    <th class="px-6 py-3 text-left">Tanggal Ditambahkan</th>
                    <th class="px-6 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($products as $index => $product) {
                        echo "<tr class='" . ($index % 2 == 0 ? 'bg-gray-50' : '') . "'>";
                        echo "<td class='px-6 py-4 text-center'>" . ($index + 1) . "</td>";
                        echo "<td class='px-6 py-4'>" . $product['product_name'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $product['description'] . "</td>";
                        echo "<td class='px-6 py-4 text-center'>Rp " . number_format($product['price'], 0, ',', '.') . "</td>";
                        echo "<td class='px-6 py-4 text-center'>" . $product['stock'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $product['category'] . "</td>";
                        echo "<td class='px-6 py-4'><img src='" . $product['image_URL'] . "' alt='" . $product['product_name'] . "' class='w-24 h-24 object-cover'></td>";
                        echo "<td class='px-6 py-4'>" . $product['created_at'] . "</td>";
                        echo "<td class='px-6 py-4'> <a href='/uasweb?page=dashboard-edit-product&get=".$product['product_ID']."' class='rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'>Edit</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include './views/components/footer.php'; ?>