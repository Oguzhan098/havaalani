<?php
declare(strict_types=1);

require_once __DIR__ . '/../../Models/FlightModel.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$BASE = '/ucus_tam_proje';
$pdo = require __DIR__ . '/../../config/database.php';
$flightModel = new FlightModel($pdo);

// GET parametresi ile uçuş ID
$flightId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($flightId <= 0) {
    http_response_code(400);
    echo "Geçersiz uçuş.";
    exit;
}

// POST işlemleri
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    try {
        if ($action === 'add' && !empty($_POST['person_id'])) {
            $flightModel->addPassenger($flightId, (int)$_POST['person_id']);
            $_SESSION['flash'] = 'Yolcu eklendi.';
            header("Location: ?id={$flightId}"); exit;
        } elseif ($action === 'remove' && !empty($_POST['person_id'])) {
            $flightModel->removePassenger($flightId, (int)$_POST['person_id']);
            $_SESSION['flash'] = 'Yolcu çıkarıldı.';
            header("Location: ?id={$flightId}"); exit;
        }
    } catch (Throwable $e) {
        $_SESSION['flash'] = 'Hata: ' . $e->getMessage();
        header("Location: ?id={$flightId}"); exit;
    }
}

// GET: uçuş ve yolcular
$flight = $flightModel->getFlightById($flightId);
if (!$flight) { echo "Uçuş bulunamadı."; exit; }

$currentPassengers = $flightModel->getPassengers($flightId);
$allPeople = $flightModel->getAllPeople();

// View çağrısı
require __DIR__ . '/../../views/flights/passengers.php';
