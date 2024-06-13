<?php
require_once __DIR__ . '/../core/Database.php';


class Site
{
    private $db;
    private $id;
    private $user_id;
    private $url;
    private $name;
    private $check_interval;
    private $status;
    private $last_checked;

    public function __construct($data = [])
    {
        $db = new Database();
        $this->db = $db->getConnection();

        if (!empty($data)) {
            $this->user_id = $data['user_id'] ?? null;
            $this->url = $data['url'] ?? null;
            $this->name = $data['name'] ?? null;
            $this->check_interval = $data['check_interval'] ?? null;
            $this->status = $data['status'] ?? 'unknown';
            $this->last_checked = $data['last_checked'] ?? null;
        }
    }

    public static function getAll()
    {
        $db = new Database();
        $pdo = $db->getConnection();

        $stmt = $pdo->query('SELECT * FROM sites');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        if ($this->id) {
            // Update existing record
            $stmt = $this->db->prepare('UPDATE sites SET user_id = :user_id, url = :url, name = :name, check_interval = :check_interval, status = :status, last_checked = :last_checked WHERE id = :id');
            $stmt->bindParam(':id', $this->id);
        } else {
            // Insert new record
            $stmt = $this->db->prepare('INSERT INTO sites (user_id, url, name, check_interval, status, last_checked) VALUES (:user_id, :url, :name, :check_interval, :status, :last_checked)');
        }
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':url', $this->url);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':check_interval', $this->check_interval);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':last_checked', $this->last_checked);

        $stmt->execute();

        if (!$this->id) {
            $this->id = $this->db->lastInsertId();
        }
    }

    public static function create($data)
    {
        $site = new Site($data);
        $site->save();
        return $site;
    }


    public function delete()
    {
        if (isset($this->id)) {
            $stmt = $this->db->prepare('DELETE FROM sites WHERE id = ?');
            $stmt->execute([$this->id]);
        }
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setLastChecked($last_checked)
    {
        $this->last_checked = $last_checked;
    }
}
?>
