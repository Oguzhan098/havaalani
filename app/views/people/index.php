<?php
declare(strict_types=1);

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
        <thead>
        <tr>
            <th>#</th>
            <th>Ad</th>
            <th>Soyad</th>
            <th>Cinsiyet</th>
            <th>Yaş</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($people as $pe): ?>
            <tr>
                <td><?= (int)$pe['id'] ?></td>
                <td><?= e($pe['first_name']) ?></td>
                <td><?= e($pe['last_name']) ?></td>
                <td><?= e($pe['gender']) ?></td>
                <td><?= (int)$pe['age'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>
