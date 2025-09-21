<?php
declare(strict_types=1);

// BASE tanımı (eğer yoksa)
if (!isset($BASE) || !$BASE) {
    $BASE = preg_replace('#/app/.*$#', '', $_SERVER['SCRIPT_NAME']);
    if (empty($BASE)) { $BASE = ''; } // kök dizin
}
?>

</main>
<script src="<?= $BASE ?>/public/assets/app.js"></script>
</body>
</html>
