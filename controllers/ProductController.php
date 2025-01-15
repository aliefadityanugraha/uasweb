<?php

require_once './models/Product.php';

class ProductController {

    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    public function getAllProductView() {
        $products = $this->productModel->getAll();

        return require_once './views/dashboard/product.php';
    }

    public function getProductDetails($productId) {

        $product = $this->productModel->getByProductId($productId);

        if ($product) {
            require_once './views/product.php';
        } else {
            return "Produk Tidak Ditemukan";
        }
    }

    public function getProductDetailsEditView($productId) {

        $product = $this->productModel->getByProductId($productId);

        if ($product) {
            require_once './views/dashboard/edit-product.php';
        } else {
            return "Produk Tidak Ditemukan";
        }
    }

    public function insertProduct($data) {
        $productName = $data['product_name'];
        $description = $data['description'];
        $price = $data['price'];
        $stock = $data['stock'];
        $category = $data['category'];
        $image_URL = $data['image_URL'];

        $result = $this->productModel->insert($productName, $description, $price, $stock, $category, $image_URL);

        if ($result) {
            echo "Produk berhasil ditambahkan!";
        } else {
            echo "Terjadi kesalahan saat menambahkan produk!";
        }
    }

    public function updateProduct($data) {
        $productId = $data['product_ID'];
        $productName = $data['product_name'];
        $description = $data['description'];
        $price = $data['price'];
        $stock = $data['stock'];
        $category = $data['category'];
        $image_URL = $data['image_URL'];

        //var_dump($image_URL);

        $result = $this->productModel->update((int)$productId, $productName, $description, $price, $stock, $category, $image_URL);

        if ($result) {
            header('location: /uasweb?page=dashboard-product');
        } else {
            echo "Terjadi kesalahan saat memperbarui produk!";
        }
    }

    public function deleteProduct($data) {

        $productId = $data['product_id'];

        $result = $this->productModel->delete($productId);

        if ($result) {
            echo "Produk berhasil dihapus!";
        } else {
            echo "Terjadi kesalahan saat menghapus produk!";
        }
    }

}
