<?php
declare(strict_types=1);
ini_set('display_errors','1'); error_reporting(E_ALL);
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

$BASE = '/ucus_tam_proje';

$pdo = require __DIR__ . '/../../config/database.php';

$people = $pdo->query("SELECT * FROM person ORDER BY id")->fetchAll();

require __DIR__ . '/../layout/header.php';
?>
<h1>Kişiler</h1>

<div class="actions">
    <a class="btn" href="<?= $BASE ?>/app/views/people/new.php">Yeni Kişi</a>
</div>

<?php if (empty($people)): ?>
    <p class="small">Kayıt yok.</p>
<?php else: ?>
    <table>
        <thead><tr><th>#</th><th>Ad</th><th>Soyad</th><th>Cinsiyet</th><th>Yaş</th></tr></thead>
        <tbody>
        <?php foreach ($people as $pe): ?>
            <tr>
                <td><?= (int)$pe['id'] ?></td>
                <td><?= htmlspecialchars($pe['first_name']) ?></td>
                <td><?= htmlspecialchars($pe['last_name']) ?></td>
                <td><?= htmlspecialchars($pe['gender']) ?></td>
                <td><?= (int)$pe['age'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>
