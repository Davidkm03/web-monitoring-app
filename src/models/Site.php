<?php

class Site
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function create($userId, $url, $name, $checkInterval)
    {
        $stmt = $this->db->prepare("INSERT INTO sites (user_id, url, name, check_interval) VALUES (:user_id, :url, :name, :check_interval)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':check_interval', $checkInterval);

        return $stmt->execute();
    }

    public function getAllByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM sites WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id, $userId)
    {
        $stmt = $this->db->prepare("DELETE FROM sites WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);

        return $stmt->execute();
    }
}
