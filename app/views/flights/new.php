<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$BASE = '/ucus_tam_proje';
require __DIR__ . '/../layout/header.php';

if (!function_exists('e')) {
    function e($v): string { return htmlspecialchars((string)($v ?? ''), ENT_QUOTES, 'UTF-8'); }
}
?>

<h1>Yeni Uçuş</h1>

<?php if (!empty($_SESSION['flash'])): ?>
    <p class="flash"><?= e($_SESSION['flash']) ?></p>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<form method="post" action="<?= $BASE ?>/app/controllers/FlightController.php" class="form-grid">
    <input type="hidden" name="action" value="create">

    <div>
        <label>Kalkış Havalimanı</label>
        <select name="departure_airport_id" required>
            <option value="">Seçin</option>
            <?php foreach ($airports as $a): ?>
                <option value="<?= (int)$a['id'] ?>"><?= e($a['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Varış Havalimanı</label>
        <select name="arrival_airport_id" required>
            <option value="">Seçin</option>
            <?php foreach ($airports as $a): ?>
                <option value="<?= (int)$a['id'] ?>"><?= e($a['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Kalkış Zamanı</label>
        <input type="datetime-local" name="departure_ts" required>
    </div>

    <div>
        <label>Varış Zamanı</label>
        <input type="datetime-local" name="arrival_ts" required>
    </div>

    <div>
        <label>Uçak (Marka — Model)</label>
        <select name="plane_id" required>
            <option value="">Seçin</option>
            <?php foreach ($planes as $p): ?>
                <?php $label = trim(($p['brand'] ?? '') . ' — ' . ($p['model'] ?? '')); ?>
                <option value="<?= (int)$p['id'] ?>"><?= e($label) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Yolcular (çoklu seçim)</label>
        <select name="passenger_ids[]" multiple size="6">
            <?php foreach ($people as $pe): ?>
                <option value="<?= (int)$pe['id'] ?>"><?= e($pe['first_name'] . ' ' . $pe['last_name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div style="grid-column:1/-1; display:flex; gap:8px;">
        <button class="btn" type="submit">Kaydet</button>
        <a class="btn secondary" href="<?= $BASE ?>/app/views/flights/index.php">İptal</a>
    </div>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>
