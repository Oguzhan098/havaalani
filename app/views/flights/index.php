<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$BASE = '/ucus_tam_proje';
require __DIR__ . '/../layout/header.php';

if (!function_exists('e')) {
    function e($v): string {
        return htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8');
    }
}
?>

<h1>Uçuşlar</h1>

<?php if (!empty($_SESSION['flash'])): ?>
    <p class="flash"><?= e($_SESSION['flash']) ?></p>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="actions">
    <a class="btn" href="<?= $BASE ?>/app/views/flights/new.php">Yeni Uçuş</a>
</div>

<table>
    <thead>
    <tr>
        <th>Sıra</th>
        <th>Kalkış</th>
        <th>Varış</th>
        <th>Kalkış Zamanı</th>
        <th>Varış Zamanı</th>
        <th>Uçak</th>
        <th>Yolcular</th>
        <th>Aksiyon</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; foreach ($flights as $f): ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= e($f['dep_airport']) ?></td>
            <td><?= e($f['arr_airport']) ?></td>
            <td><?= e($f['departure_ts']) ?></td>
            <td><?= e($f['arrival_ts']) ?></td>
            <td><?= e($f['plane_model']) ?></td>
            <td class="small">
                <?php
                $passengers = $f['passengers'];
                if (is_string($passengers)) $passengers = json_decode($passengers, true);
                if (is_array($passengers)) {
                    foreach ($passengers as $p) echo e(($p['first_name']??'').' '.($p['last_name']??'')) . '<br>';
                }
                ?>
            </td>
            <td class="actions" style="display:flex; gap:6px;">
                <a class="btn" href="<?= $BASE ?>/app/views/flights/passengers.php?id=<?= (int)$f['id'] ?>">Yolcuları Yönet</a>
                <form method="post" action="<?= $BASE ?>/app/controllers/FlightController.php" onsubmit="return confirm('Uçuş silinsin mi?')">
                    <input type="hidden" name="delete_id" value="<?= (int)$f['id'] ?>">
                    <button class="btn danger" type="submit">Sil</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
