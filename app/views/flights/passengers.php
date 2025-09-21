<?php
declare(strict_types=1);
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

require __DIR__ . '/../layout/header.php';
if (!function_exists('e')) {
    function e($v): string { return htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8'); }
}
?>

<h1>Uçuş Yolcularını Yönet</h1>

<div class="card">
    <div><b>Uçuş #<?= (int)$flight['id'] ?></b></div>
    <div><?= e($flight['dep_airport']) ?> → <?= e($flight['arr_airport']) ?></div>
    <div><?= e($flight['departure_ts']) ?> — <?= e($flight['arrival_ts']) ?> (<?= e($flight['plane_model']) ?>)</div>
</div>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="flash"><?= e($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<div class="form-grid" style="align-items:end;">
    <div>
        <label>Yolcu Ekle</label>
        <form method="post">
            <input type="hidden" name="action" value="add">
            <select name="person_id" required>
                <option value="">Seçin</option>
                <?php foreach ($allPeople as $pe): ?>
                    <option value="<?= (int)$pe['id'] ?>"><?= e($pe['first_name'].' '.$pe['last_name']) ?></option>
                <?php endforeach; ?>
            </select>
            <button class="btn" type="submit">Ekle</button>
        </form>
    </div>
</div>

<h2>Mevcut Yolcular</h2>
<?php if (empty($currentPassengers)): ?>
    <p class="small">Bu uçuşta yolcu yok.</p>
<?php else: ?>
    <table>
        <thead><tr><th>#</th><th>Ad Soyad</th><th></th></tr></thead>
        <tbody>
        <?php $i=1; foreach ($currentPassengers as $pe): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= e($pe['first_name'].' '.$pe['last_name']) ?></td>
                <td>
                    <form method="post" onsubmit="return confirm('Yolcu çıkarılsın mı?')">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" name="person_id" value="<?= (int)$pe['id'] ?>">
                        <button class="btn danger" type="submit">Çıkar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<div class="actions">
    <a class="btn secondary" href="<?= $BASE ?>/app/views/flights/index.php">← Uçuşlar</a>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
