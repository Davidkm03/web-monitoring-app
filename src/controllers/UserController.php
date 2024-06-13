<?php
require_once __DIR__ . '/../helpers/csrf.php';
require_once __DIR__ . '/../helpers/sanitize.php'; // Incluir el archivo sanitize.php

class UserController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require __DIR__ . '/../views/user/register.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verifyCsrfToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            $username = sanitizeString($_POST['username']);
            $email = sanitizeString($_POST['email']);
            $password = password_hash(sanitizeString($_POST['password']), PASSWORD_DEFAULT);

            $db = new Database();
            $pdo = $db->getConnection();

            $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
            if ($stmt->execute([$username, $email, $password])) {
                // Iniciar sesión automáticamente después de registrar
                $user_id = $pdo->lastInsertId();
                $_SESSION['user_id'] = $user_id;
                header('Location: /dashboard');
                exit;
            } else {
                echo 'Failed to register user';
            }
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require __DIR__ . '/../views/user/login.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verifyCsrfToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            $email = sanitizeString($_POST['email']);
            $password = sanitizeString($_POST['password']);

            $db = new Database();
            $pdo = $db->getConnection();

            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /dashboard');
                exit;
            } else {
                echo 'Invalid email or password';
            }
        }
    }

    public function dashboard()
    {
        $db = new Database();
        $pdo = $db->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM sites WHERE user_id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $sites = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/user/dashboard.php';
    }
}
?>