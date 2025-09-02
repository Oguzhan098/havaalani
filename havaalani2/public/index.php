<?php
// public/index.php
require_once __DIR__ . "/../app/Controllers/FlightController.php";

$controller = new FlightController();

$action = $_GET['action'] ?? 'index';

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST);
} else {
    $controller->index();
}
