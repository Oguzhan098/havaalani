<?php
declare(strict_types=1);

require __DIR__ . '/../layout/header.php';
?>

<h1>Yeni Kişi</h1>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="flash"><?= e($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<form method="post" action="<?= $BASE ?>/app/controllers/PeopleController.php" class="form-grid">
    <div>
        <label>Ad</label>
        <input type="text" name="first_name" required>
    </div>
    <div>
        <label>Soyad</label>
        <input type="text" name="last_name" required>
    </div>
    <div>
        <label>Cinsiyet</label>
        <select name="gender" required>
            <option value="">Seçiniz</option>
            <option value="Erkek">Erkek</option>
            <option value="Kadın">Kadın</option>
            <option value="Diğer">Diğer</option>
        </select>
    </div>
    <div>
        <label>Yaş</label>
        <input type="number" name="age" min="0" required>
    </div>
    <div style="grid-column:1/-1">
        <button class="btn" type="submit">Kaydet</button>
        <a class="btn secondary" href="<?= $BASE ?>/app/views/people/index.php">İptal</a>
    </div>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>
