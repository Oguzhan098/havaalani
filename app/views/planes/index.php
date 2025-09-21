<?php
declare(strict_types=1);
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
        <tr>
            <th>#</th>
            <th>Marka</th>
            <th>Model</th>
            <th>Kapasite</th>
            <th>Yıl</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($planes as $p): ?>
            <tr>
                <td><?= (int)($p['id'] ?? 0) ?></td>
                <td><?= e($p['brand'] ?? '') ?></td>
                <td><?= e($p['model'] ?? '') ?></td>
                <td><?= (int)($p['capacity'] ?? 0) ?></td>
                <td><?= isset($p['year']) ? (int)$p['year'] : '' ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>
