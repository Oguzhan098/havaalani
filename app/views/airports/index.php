<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$BASE = '/ucus_tam_proje';

require __DIR__ . '/../layout/header.php';
?>

<h1>Havalimanları</h1>

<?php if (!empty($_SESSION['flash'])): ?>
    <p class="flash"><?= htmlspecialchars($_SESSION['flash']) ?></p>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="actions">
    <a class="btn" href="<?= $BASE ?>/app/views/airports/new.php">Yeni Havalimanı</a>
</div>

<?php if (empty($airports)): ?>
    <p class="small">Kayıtlı havalimanı bulunamadı.</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Ad</th>
            <th>Pist</th>
            <th>Uçak Kapasitesi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($airports as $a): ?>
            <tr>
                <td><?= (int)$a['id'] ?></td>
                <td><?= htmlspecialchars($a['name']) ?></td>
                <td><?= (int)$a['pist_sayisi'] ?></td>
                <td><?= (int)$a['ucak_kapasitesi'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>
