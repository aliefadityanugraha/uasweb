<?php include 'components/header.php';?>
<div>
    <?php foreach($myorder as $order) : ?>
        <div class="bg-gray-100 shadow-md rounded-lg p-10 m-5">
            <?php
            
                echo '<h2 class="text-xl font-semibold text-gray-800 mb-4">Status: ';
                if($order[4] == null) {
                    echo 'Waiting Aproval';
                } else {
                    if($order[4] == 'not_approved') {
                        echo 'Not Aproved';
                    } else {
                        echo 'Permintaan Disetujui, Barang Bisa Disewa';
                    }
                }
                echo '</h2>';
                $orderItems = json_decode($order[1]);
                if (is_array($orderItems)) {
                    echo '<h2 class="text-xl font-semibold text-gray-800 mb-4">Order:</h2>';
                    echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
                    
                    foreach ($orderItems as $item) {
                        echo '<div class="bg-gray-50 shadow rounded-lg p-4 flex items-center">';
                        echo '<img class="w-20 h-20 object-cover rounded mr-4" src="' . htmlspecialchars($item->image) . '" alt="' . htmlspecialchars($item->name) . '">';
                        echo '<div>';
                        echo '<h3 class="font-bold text-lg text-gray-800">' . htmlspecialchars($item->name) . '</h3>';
                        echo '<p class="text-gray-600">Price: Rp ' . number_format($item->price, 0, ',', '.') . '</p>';
                        echo '<p class="text-gray-600">Quantity: ' . htmlspecialchars($item->quantity) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }

                    echo '</div>';
                } else {
                    echo '<p class="text-red-500">Invalid items data.</p>';
                }
            ?>
        </div>
    <?php endforeach; ?>
</div>


<?php include 'components/footer.php'; ?> 