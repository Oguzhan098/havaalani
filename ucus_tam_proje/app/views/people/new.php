<?php
declare(strict_types=1);
ini_set('display_errors','1'); error_reporting(E_ALL);
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

$BASE = '/ucus_tam_proje';

$pdo = require __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO person (first_name,last_name,gender,age) VALUES (:f,:l,:g,:a)");
    $stmt->execute([
        ':f' => trim((string)$_POST['first_name']),
        ':l' => trim((string)$_POST['last_name']),
        ':g' => trim((string)$_POST['gender']),
        ':a' => (int)$_POST['age'],
    ]);
    $_SESSION['flash'] = 'Kişi eklendi.';
    header("Location: {$BASE}/app/views/people/index.php");
    exit;
}

require __DIR__ . '/../layout/header.php';
?>
<h1>Yeni Kişi</h1>

<form method="post" action="<?= $BASE ?>/app/views/people/new.php" class="form-grid">
    <div><label>Ad</label><input type="text" name="first_name" required></div>
    <div><label>Soyad</label><input type="text" name="last_name" required></div>
    <div><label>Cinsiyet</label>
        <select name="gender" required>
            <option value="">Seçiniz</option>
            <option value="Erkek">Erkek</option>
            <option value="Kadın">Kadın</option>
            <option value="Diğer">Diğer</option>
        </select>
    </div>
    <div><label>Yaş</label><input type="number" name="age" min="0" required></div>
    <div style="grid-column:1/-1">
        <button class="btn" type="submit">Kaydet</button>
        <a class="btn secondary" href="<?= $BASE ?>/app/views/people/index.php">İptal</a>
    </div>
</form>
<?php require __DIR__ . '/../layout/footer.php'; ?>
