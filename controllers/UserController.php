<?php
session_start();
require_once __DIR__ . '/../models/User.php';

$userModel = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // REGISTER
    if (isset($_POST['register'])) {
        $userModel->register(
            $_POST['username'],
            $_POST['password'],
            $_POST['email'],
            $_POST['name']
        );
        header("Location: ../views/login.php");
        exit;
    }

    // LOGIN
    if (isset($_POST['login'])) {
        $user = $userModel->login($_POST['username'], $_POST['password']);
        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: ../views/dashboard.php");
            exit;
        } else {
            echo "Login gagal: Username atau password salah.";
        }
    }

    // UPDATE PROFILE
    if (isset($_POST['update'])) {
        $userModel->update(
            $_SESSION['user']['id'],
            $_POST['username'],
            $_POST['email'],
            $_POST['name'],
            $_POST['password'] // opsional
        );

        // Update session agar konsisten
        $_SESSION['user']['username'] = $_POST['username'];
        $_SESSION['user']['email'] = $_POST['email'];
        $_SESSION['user']['name'] = $_POST['name'];

        header("Location: ../views/profile.php");
        exit;
    }

    // DELETE ACCOUNT
    if (isset($_POST['delete'])) {
        $userModel->delete($_SESSION['user']['id']);
        session_destroy();
        header("Location: ../index.php");
        exit;
    }
}
