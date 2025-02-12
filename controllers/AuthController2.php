<?php

require_once './models/User.php';

class AuthController {

    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }
    
    public function register(array $data): void {
        session_start();
        
        $email = strtolower(trim($data["email"]));
        $password = $data["password"];
        $confirm_password = $data["confirm-password"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Format email tidak valid.";
            header('Location: /uasweb?page=register');
            exit();
        }

        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Password tidak sesuai.";
            header('Location: /uasweb?page=register');
            exit();
        }

        $existingUser = $this->userModel->getByEmail($email);
        if ($existingUser) {
            $_SESSION['error'] = "Email sudah dipakai, gunakan email lain.";
            header('Location: /uasweb?page=register');
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $this->userModel->insert($email, $hashedPassword);

        if ($result) {
            $_SESSION['success'] = "Registrasi berhasil. Silakan login.";
            header('Location: /uasweb?page=login');
            exit();
        } else {
            $_SESSION['error'] = "Terjadi kesalahan saat registrasi.";
            header('Location: /uasweb?page=register');
            exit();
        }
    }

    public function login(array $data): void {
        session_start();
        
        $email = strtolower(trim($data["email"]));
        $password = $data["password"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Format email tidak valid.";
            header('Location: /uasweb?page=login');
            exit();
        }

        $user = $this->userModel->getByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                "id" => $user['id'],
                "email" => $user['email'],
                "role" => $user['role']
            ];
            $_SESSION['success'] = "Login berhasil.";
            header('Location: /uasweb');
            exit();
        } else {
            $_SESSION['error'] = "Email atau password salah.";
            header('Location: /uasweb?page=login');
            exit();
        }
    }

    public function logout(): void {
        session_start();
        session_unset();
        session_destroy();
    
        header('Location: /uasweb');
        exit();
    }
}