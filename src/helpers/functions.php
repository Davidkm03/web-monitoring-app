<?php

function sanitizeString($string)
{
    return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
}

function verifyCsrfToken($token)
{
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        throw new Exception('Invalid CSRF token');
    }
}

// Genera y guarda el token CSRF en la sesión
function generateCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
?>
