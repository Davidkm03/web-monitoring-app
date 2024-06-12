<?php

class SiteController
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = $_POST['url'];
            $name = $_POST['name'];
            $checkInterval = $_POST['check_interval'];
            $userId = $_SESSION['user_id'];

            $site = new Site();
            if ($site->create($userId, $url, $name, $checkInterval)) {
                echo "Site added successfully!";
            } else {
                echo "Failed to add site.";
            }
        } else {
            require __DIR__ . '/../views/site/add.php';
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
}
