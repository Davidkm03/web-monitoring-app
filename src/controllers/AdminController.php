<?php

class AdminController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = sanitizeString($_POST['username']);
            $password = sanitizeString($_POST['password']);

            $admin = new User(); // Reutilizando User para el administrador
            if ($admin->authenticate($username, $password)) {
                $_SESSION['admin_logged_in'] = true;
                header('Location: /admin/dashboard');
            } else {
                echo "Invalid credentials";
            }
        } else {
            require __DIR__ . '/../views/admin/login.php';
        }
    }

    public function dashboard()
    {
        if ($_SESSION['user_role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        require __DIR__ . '/../views/admin/dashboard.php';
    }

    public function manageSites()
    {
        if ($_SESSION['user_role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $sites = Site::getAll();
        require __DIR__ . '/../views/admin/manage-sites.php';
    }

    public function manageUsers()
    {
        if ($_SESSION['user_role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $users = User::getAll();
        require __DIR__ . '/../views/admin/manage-users.php';
    }
}
?>
