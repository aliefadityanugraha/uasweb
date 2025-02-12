<?php include './views/components/header-dashboard.php';?>
<div>
    <?php foreach($orders as $order) : ?>
        <div class="bg-gray-100 shadow-md rounded-lg p-10 m-5">
            <?php
                 // Decode order items
                $items = json_decode($order["order_items"]);
                if (is_array($items)) {
                    echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">';
                    foreach ($items as $item) {
                        echo '<div class="bg-gray-50 shadow rounded-lg p-4 flex items-center">';
                        echo '<img class="w-20 h-20 object-cover rounded mr-4" src="' . htmlspecialchars($item->image) . '" alt="' . htmlspecialchars($item->name) . '">';
                        echo '<div>';
                        echo '<h3 class="font-bold text-lg text-gray-800">' . htmlspecialchars($item->name) . '</h3>';
                        echo '<p class="text-gray-600">Harga: Rp ' . number_format($item->price, 0, ',', '.') . '</p>';
                        echo '<p class="text-gray-600">Jumlah: ' . htmlspecialchars($item->quantity) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    } ?>

                    <!-- option -->
                   <form class="flex align-center justify-between" action="/uasweb/?page=aproval" method="POST">
                        <div class="sm:col-span-3">
                            <input type="hidden" name="order_id" value="<?php echo $order['order_ID'] ?>">
                            <label for="status" class="block text-sm/6 font-medium text-gray-900">Status</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="status" name="status" autocomplete="status-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option value="approved">Disetujui</option>
                                    <option value="not_approved">Tidak Disetujui</option>
                                </select>
                                <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="h-full">
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                        </div>
                   </form>

                    <?php
                    echo '</div>';
                } else {
                    echo '<p class="text-red-500">Invalid items data.</p>';
                }
                echo '</div>';
            ?>
        </div>
    <?php endforeach; ?>
</div>


<?php include './views/components/footer.php'; ?> 