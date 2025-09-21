<?php
declare(strict_types=1);
ini_set('display_errors','1'); error_reporting(E_ALL);
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

$BASE = $BASE ?? '/ucus_tam_proje';
$pdo  = require __DIR__ . '/../../config/database.php';

$planes = $pdo->query("SELECT * FROM plane ORDER BY id")->fetchAll();

require __DIR__ . '/../layout/header.php';
?>
<h1>Uçaklar</h1>

<div class="actions">
    <a class="btn" href="<?= $BASE ?>/app/views/planes/new.php">Yeni Uçak</a>
</div>

<?php if (empty($planes)): ?>
    <p class="small">Kayıt yok.</p>
<?php else: ?>
    <table>
        <thead>
        <tr><th>#</th><th>Marka</th><th>Model</th><th>Kapasite</th><th>Yıl</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($planes as $p): ?>
            <tr>
                <td><?= isset($p['id']) ? (int)$p['id'] : '' ?></td>
                <td><?= e($p['brand'] ?? '') ?></td>
                <td><?= e($p['model'] ?? '') ?></td>
                <td><?= isset($p['capacity']) ? (int)$p['capacity'] : '' ?></td>
                <td><?= isset($p['year']) && $p['year'] !== null ? (int)$p['year'] : '' ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>
