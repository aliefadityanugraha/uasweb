<?php include 'components/header.php'; ?>

<div class="flex justify-center h-screen dark:bg-gray-900 dark:text-gray-100">
    <div class="bg-white dark:bg-gray-800 dark:text-gray-100">
        <div class="mx-auto max-w-2xl px-4 py-5 sm:px-6 sm:py-10 lg:max-w-7xl lg:px-2">
            <h2 class="sr-only">Products</h2>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php foreach ($products as $index => $product) { ?>
                    <div class="product-item dark:bg-gray-800 dark:hover:bg-gray-700">
                        <a href="/uasweb?page=product&get=<?php echo $product['product_ID']; ?>" class="group">
                            <img src="<?php echo $product['image_URL']; ?>" 
                                alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." 
                                class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8] dark:bg-gray-700">
                            
                            <h3 class="mt-4 text-sm text-gray-700 dark:text-gray-300"><?php echo $product['product_name']; ?></h3>
                            
                            <p class="mt-1 text-lg font-medium text-gray-900 dark:text-gray-200">
                                Rp <?php echo number_format($product['price'], 0, ',', '.'); ?>
                            </p>
                        </a>

                        <!-- Tombol Add to Cart -->
                        <button style=" background-color: brown !important;" class="add-to-cart-btn mt-4 px-4 py-2 text-white rounded-md dark:bg-blue-500 dark:hover:bg-blue-400"
                                data-product-id="<?php echo $product['product_ID']; ?>"
                                data-product-name="<?php echo $product['product_name']; ?>"
                                data-product-price="<?php echo $product['price']; ?>"
                                data-product-image="<?php echo $product['image_URL']; ?>">
                            Add to Cart
                        </button>
                    </div>
                <?php } ?>
            </div>

        </div>

        <!-- Keranjang Pembelian -->
        <div id="cart-container" class="dark:bg-gray-800 dark:text-gray-100">
            <h2>Keranjang Belanja</h2>
            <div id="cart-items"></div>
            <p>Total: Rp <span id="cart-total">0</span></p>
            <button id="checkout-button" style=" background-color: green !important;" class="mt-4 px-4 py-2 text-white rounded-md dark:bg-blue-500 dark:hover:bg-blue-400">Checkout</button>
        </div>
    </div>
</div>

<script src="./assets/js/cart.js"></script>
<?php include 'components/footer.php'; ?>
