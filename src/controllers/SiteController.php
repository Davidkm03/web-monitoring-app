<?php

require_once __DIR__ . '/../helpers/csrf.php';

class SiteController
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'], // Asumiendo que el ID del usuario está almacenado en la sesión
                'url' => sanitizeString($_POST['url']),
                'name' => sanitizeString($_POST['name']),
                'check_interval' => (int)$_POST['check_interval'],
            ];

            try {
                Site::create($data);
                echo "Site added successfully!";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            require __DIR__ . '/../views/user/add_site.php';
        }
    }
    public function list()
    {
        $userId = $_SESSION['user_id'];
        $site = new Site();
        $sites = $site->getAllByUserId($userId);

        require __DIR__ . '/../views/site/list.php';
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verifyCsrfToken($_POST['csrf_token'])) {
                die('Invalid CSRF token');
            }

            $id = $_POST['id'];
            $userId = $_SESSION['user_id'];

            $site = new Site();
            if ($site->delete($id, $userId)) {
                echo "Site deleted successfully!";
            } else {
                echo "Failed to delete site.";
            }
        }
    }

    public function view($id)
    {
        $userId = $_SESSION['user_id'];
        $site = new Site();
        $siteDetails = $site->getByIdAndUserId($id, $userId);
        $checkHistory = $site->getCheckHistory($id);

        require __DIR__ . '/../views/site/view.php';
    }
}
