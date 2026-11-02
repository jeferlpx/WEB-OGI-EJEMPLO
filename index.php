<?php

// Redireccionar transparentemente hacia el directorio public de Laravel
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$queryString = $_SERVER['QUERY_STRING'] ?? '';

$basePath = strtok($requestUri, '?');
$target = rtrim($basePath, '/') . '/public/' . ($queryString !== '' ? '?' . $queryString : '');

header('Location: ' . $target, true, 302);
exit;
