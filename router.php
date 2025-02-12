<?php

require_once './controllers/AuthController.php';
require_once './controllers/ProductController.php';
require_once './controllers/OrderController.php';
require_once './models/Product.php';
require_once './models/User.php';

class Router {
    private $AuthController;
    private $ProductController;
    private $OrderController;
    private $ModelProduct;
    private $ModelUser;

    public function __construct() {
        $this->AuthController = new AuthController();
        $this->ProductController = new ProductController();
        $this->OrderController = new OrderController();
        $this->ModelProduct = new Product();
        $this->ModelUser = new User();
    }

    private function checkAuth() {
        if (!isset($_SESSION['user'])) {
            header('Location: /uasweb?page=login');
            exit();
        }
    }

    private function checkRole($requiredRole) {
        $user_id = $_SESSION['user']['id'];
        $user = $this->ModelUser->getById($user_id);

        if ($user['role'] !== $requiredRole) {
            echo "Akses ditolak: Anda tidak memiliki hak untuk mengakses halaman ini.";
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
                        $this->checkRole("admin");
                        require_once 'views/dashboard/dashboard.php';
                        break;
                    // Get Product View
                    case 'dashboard-product':
                        $this->checkAuth();
                        $this->checkRole("admin");
                        $this->ProductController->getAllProductView();
                        break;
                    // Tambah Data Barang
                    case 'dashboard-add-product':
                        $this->checkAuth();
                        $this->checkRole("admin");
                        require_once './views/dashboard/tambah-product.php';
                        break;
                    // Tambah Data Barang
                    case 'dashboard-edit-product':
                        $this->checkAuth();
                        $this->checkRole("admin");
                        $this->ProductController->getProductDetailsEditView((int)$get);
                        break;
                    //order page
                    case 'order':
                        $this->checkAuth();
                        $this->OrderController->getMyOrder();
                        break;
                    case 'dashboard-order':
                        $this->checkAuth();
                        $this->checkRole("admin");
                        $this->OrderController->getAllOrderView();
                        break;
                     //Delete Order
                     case 'dashboard-delete-product':
                        $this->checkAuth();
                        $this->ProductController->deleteProduct((int)$get);
                        break;
                    default:
                        header('location: /uasweb');
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
                        $this->checkRole("admin");
                        $this->ProductController->insertProduct($data);
                        break;
                    case 'dashboard-edit-product':
                        $this->checkAuth();
                        $this->checkRole("admin");
                        $this->ProductController->updateProduct($data);
                        break;
                    //Add Order
                    case 'order':
                        $this->checkAuth();
                        $this->OrderController->addOrder($data);
                        break;
                    case 'aproval':
                        $this->checkAuth();
                        $this->checkRole("admin");
                        $this->OrderController->aprovalStatus($data);
                        break;
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

