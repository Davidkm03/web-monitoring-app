<?php

class UserController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            if ($user->create($username, $email, $password)) {
                echo "User registered successfully!";
            } else {
                echo "Failed to register user.";
            }
        } else {
            require __DIR__ . '/../views/user/register.php';
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $userData = $user->findByEmail($email);

            if ($userData && password_verify($password, $userData['password'])) {
                $_SESSION['user_id'] = $userData['id'];
                echo "User logged in successfully!";
            } else {
                echo "Invalid email or password.";
            }
        } else {
            require __DIR__ . '/../views/user/login.php';
        }
    }
}
