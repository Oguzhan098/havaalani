<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Uçuşlar</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
<h1>Uçuş Listesi</h1>

<form method="POST" action="/?action=store">
    Nereden: <input type="text" name="nereden" required><br>
    Nereye: <input type="text" name="nereye" required><br>
    Yolcu Sayısı: <input type="number" name="yolcu_sayisi" required><br>
    Başlangıç: <input type="datetime-local" name="baslangic_zamani" required><br>
    Bitiş: <input type="datetime-local" name="bitis_zamani" required><br>
    Uçak ID: <input type="number" name="ucak_id" required><br>
    Havaalanı ID: <input type="number" name="havaalani_id" required><br>
    <button type="submit">Uçuş Ekle</button>
</form>

<hr>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nereden</th>
        <th>Nereye</th>
        <th>Yolcu Sayısı</th>
        <th>Başlangıç</th>
        <th>Bitiş</th>
        <th>Uçak ID</th>
        <th>Havaalanı ID</th>
    </tr>
    <?php foreach ($flights as $f): ?>
        <tr>
            <td><?= $f['id'] ?></td>
            <td><?= $f['nereden'] ?></td>
            <td><?= $f['nereye'] ?></td>
            <td><?= $f['yolcu_sayisi'] ?></td>
            <td><?= $f['baslangic_zamani'] ?></td>
            <td><?= $f['bitis_zamani'] ?></td>
            <td><?= $f['ucak_id'] ?></td>
            <td><?= $f['havaalani_id'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
