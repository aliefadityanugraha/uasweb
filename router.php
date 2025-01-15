<?php

require_once './controllers/AuthController.php';
require_once './controllers/ProductController.php';
require_once './models/Product.php';

class Router {
    private $AuthController;
    private $ProductController;
    private $ModelProduct;

    public function __construct() {
        $this->AuthController = new AuthController();
        $this->ProductController = new ProductController();
        $this->ModelProduct = new Product();
    }

    private function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /uasweb?page=login');
            exit();
        }
    }

    public function route($method, $page, $get, $data) {
        switch($method) {
            case 'GET':
                switch ($page) {
                    case 'home':
                        $title = 'Home';
                        $products = $this->ModelProduct->getAll();
                        require_once 'views/home.php';
                        break;
                    case 'login':
                        require_once 'views/login.php';
                        break;
                    case 'register':
                        require_once 'views/register.php';
                        break;
                    case 'product':
                        $title = 'Product';
                        $product = $this->ProductController->getProductDetails((int)$get);
                        break;
                    // Dashboard Route
                    case 'dashboard':
                        $this->checkAuth();
                        require_once 'views/dashboard/dashboard.php';
                        break;
                    // Get Product View
                    case 'dashboard-product':
                        $this->checkAuth();
                        $this->ProductController->getAllProductView();
                        break;
                    // Tambah Data Barang
                    case 'dashboard-add-product':
                        $this->checkAuth();
                        require_once './views/dashboard/tambah-product.php';
                        break;
                    // Tambah Data Barang
                    case 'dashboard-edit-product':
                        $this->checkAuth();
                        $this->ProductController->getProductDetailsEditView((int)$get);
                        break;
                    default:
                        require_once 'views/home.php';
                        break;
                }
                break;
            case 'POST':
                switch ($page) {
                    case 'login':
                        $this->AuthController->login($data);
                        break;
                    case 'register':
                        $this->AuthController->register($data);
                        break;
                    case 'logout':
                        $this->AuthController->logout();
                        break;
                    //Tambah Barang POST
                    case 'dashboard-add-product':
                        $this->checkAuth();
                        $this->ProductController->insertProduct($data);
                    case 'dashboard-edit-product':
                        $this->checkAuth();
                        $this->ProductController->updateProduct($data);
                    default:
                        http_response_code(404);
                        echo 'Page not found.';
                        break;
                }
                break;
            default:
                http_response_code(405);
                echo 'Method not allowed.';
                break;
        }
    }
}
