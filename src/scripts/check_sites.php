<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Site.php';

function checkSiteStatus($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return ($httpcode >= 200 && $httpcode < 400) ? 'online' : 'offline';
}

function sendNotification($siteId)
{
    $db = (new Database())->getConnection();
    $stmt = $db->prepare("SELECT u.email, s.url FROM users u JOIN sites s ON u.id = s.user_id WHERE s.id = :site_id");
    $stmt->bindParam(':site_id', $siteId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $to = $result['email'];
    $subject = "Site Offline: " . $result['url'];
    $message = "The site " . $result['url'] . " is currently offline. Please check the site for more details.";
    $headers = "From: no-reply@yourdomain.com\r\n" .
               "Reply-To: no-reply@yourdomain.com\r\n" .
               "X-Mailer: PHP/" . phpversion();

    mail($to, $subject, $message, $headers);
}

$sites = Site::getAll();

foreach ($sites as $site) {
    $status = checkSiteStatus($site['url']);
    $siteObj = new Site($site);
    $siteObj->setStatus($status);
    $siteObj->setLastChecked(date('Y-m-d H:i:s'));
    $siteObj->save();

    // Enviar notificación si el sitio está offline
    if ($status === 'offline') {
        sendNotification($site['id']);
    }

    // Agregar mensajes de depuración
    echo "Processed site: " . $site['name'] . "\n";
    echo "Status: " . $status . "\n";
}
?>
