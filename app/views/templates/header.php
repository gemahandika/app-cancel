<!DOCTYPE html>
<html>

<head>
    <title>App Cancel</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
</head>

<body>
    <header>
        <h2>Header - App Cancel</h2>

        <?php if (isset($_SESSION['login'])): ?>
            <a href="<?= BASE_URL ?>/auth/logout">Logout</a>
        <?php endif; ?>

    </header>
    <main>