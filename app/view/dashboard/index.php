<?php
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h2>Selamat Datang, <?= htmlspecialchars($user['name']) ?> (<?= $user['role'] ?>)</h2>
    <a href="<?= base_url('logout') ?>">Logout</a>

    <hr>
    <p>Menu umum</p>
    <ul>
        <li><a href="#">Beranda</a></li>
    </ul>

    <?php if ($user['role'] === 'superadmin' || $user['role'] === 'admin'): ?>
        <p>Menu Admin:</p>
        <ul>
            <li><a href="#">Manajemen User</a></li>
        </ul>
    <?php endif; ?>

    <?php if ($user['role'] === 'agen'): ?>
        <p>Menu Agen:</p>
        <ul>
            <li><a href="#">Pesanan Agen</a></li>
        </ul>
    <?php endif; ?>
</body>

</html>