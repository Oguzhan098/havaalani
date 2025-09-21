<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Models/AirportModel.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$BASE = '/ucus_tam_proje';
$pdo = require __DIR__ . '/../../config/database.php';
$airportModel = new AirportModel($pdo);

// POST isteği varsa yeni havalimanı ekle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $airportModel->create($_POST);
    $_SESSION['flash'] = 'Havalimanı eklendi.';
    header("Location: {$BASE}/app/views/airports/index.php");
    exit;
}

// Tüm havalimanlarını al
$airports = $airportModel->getAll();

// View’ı yükle
require __DIR__ . '/../../views/airports/index.php';
