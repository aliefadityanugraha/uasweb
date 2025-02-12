<?php

require_once './models/User.php';

class AuthController {

    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }
    
    public function register(array $data) {
        
        $email = strtolower($data["email"]);
        $password = $data["password"];
        $confirm_password = $data["confirm-password"];

        $existingUser = $this->userModel->getByEmail($email);
        if ($existingUser) {
            return "Email Sudah Dipakai, Gunakan Email Lain!!!";
        }

        if ($password !== $confirm_password) {
            return "Password Tidak Sesuai, Tulis Password Dengan Benar";
        }

        
        $result = $this->userModel->insert($email, $password);

        if($result) {
            return header('location: /uasweb?page=login');
        } else {
            return "Terjadi Kesalahan Saat Registrasi";
        }
    }

    public function login(array $data) {
        $email = strtolower($data["email"]);
        $password = $data["password"];

        $user = $this->userModel->getByEmail($email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = array("id" => $user['id'], "email" => $user['email'], "role" => $user['role']);
                return header('location: /uasweb');
            } else {
                echo "Password Salah, Mohon Coba Lagi";
                return false;
            }
        } else {
            echo "Email Tidak Terdaftar";
            return false;
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    
        header('Location: /uasweb');
        exit();
    }
    

}