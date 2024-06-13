<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../core/Database.php';

$db = (new Database())->getConnection();
$stmt = $db->prepare("SELECT * FROM site_checks ORDER BY checked_at DESC");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $check) {
    echo "Site ID: " . $check['site_id'] . " - Status: " . $check['status'] . " - Checked At: " . $check['checked_at'] . "\n";
}
