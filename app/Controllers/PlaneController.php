<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

$BASE = '/ucus_tam_proje';
$pdo  = require __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/PlaneModel.php';

$planeModel = new PlaneModel($pdo);

// POST isteği ile yeni uçak ekleme
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $planeModel->create([
        'brand' => trim((string)($_POST['brand'] ?? '')) ?: null,
        'model' => trim((string)$_POST['model']),
        'capacity' => (int)$_POST['capacity'],
        'year' => ($_POST['year'] ?? '') !== '' ? (int)$_POST['year'] : null
    ]);
    $_SESSION['flash'] = 'Uçak eklendi.';
    header("Location: {$BASE}/app/views/planes/index.php");
    exit;
}

// Tüm uçakları çek
$planes = $planeModel->getAll();

// View yükleme
require __DIR__ . '/../views/planes/index.php';
