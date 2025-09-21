<?php
declare(strict_types=1);
require __DIR__ . '/../layout/header.php';
?>

<h1>Yeni Uçak</h1>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="flash"><?= e($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<form method="post" action="<?= $BASE ?>/app/controllers/PlaneController.php" class="form-grid">
    <div><label>Marka</label><input type="text" name="brand"></div>
    <div><label>Model</label><input type="text" name="model" required></div>
    <div><label>Kapasite</label><input type="number" name="capacity" min="1" required></div>
    <div><label>Yıl</label><input type="number" name="year" min="1950" max="2100"></div>
    <div style="grid-column:1/-1">
        <button class="btn" type="submit">Kaydet</button>
        <a class="btn secondary" href="<?= $BASE ?>/app/views/planes/index.php">İptal</a>
    </div>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>
