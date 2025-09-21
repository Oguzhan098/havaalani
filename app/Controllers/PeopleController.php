<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../Models/PeopleModel.php';

$BASE = '/ucus_tam_proje';
$pdo  = $pdo ?? require __DIR__ . '/../config/database.php';
$peopleModel = new PeopleModel($pdo);

// POST isteği ile yeni kişi ekleme
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $peopleModel->create($_POST);
    $_SESSION['flash'] = 'Kişi eklendi.';
    header("Location: {$BASE}/app/views/people/index.php");
    exit;
}

// Tüm kişileri listeleme
$people = $peopleModel->all();

// e() helper
if (!function_exists('e')) {
    function e($v): string {
        return htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

// View yükleme
require __DIR__ . '/../views/people/index.php';
