<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start();

$BASE = '/ucus_tam_proje'; // projeni test ortamına göre değiştir

// PDO bağlantısı
$pdo = require __DIR__ . '/../app/config/database.php';

// Helper fonksiyonlar
function view(string $name, array $data = []): void {
    extract($data);
    require __DIR__ . '/../app/layout/header.php';
    require __DIR__ . "/../app/views/{$name}.php";
    require __DIR__ . '/../app/layout/footer.php';
}

function redirect(string $to): void {
    header("Location: {$to}");
    exit;
}

// Basit router
$request = $_GET['page'] ?? 'flights/index';

$routes = [
    'flights/index' => fn() => view('flights/index'),
    'flights/new'   => fn() => view('flights/new'),
    'airports/index'=> fn() => view('airports/index'),
    'airports/new'  => fn() => view('airports/new'),
    'people/index'  => fn() => view('people/index'),
    'people/new'    => fn() => view('people/new'),
    'planes/index'  => fn() => view('planes/index'),
    'planes/new'    => fn() => view('planes/new'),
];

if (isset($routes[$request])) {
    $routes[$request]();
} else {
    http_response_code(404);
    echo "Sayfa bulunamadı.";
}
