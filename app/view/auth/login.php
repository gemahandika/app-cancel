<!DOCTYPE html>
<html>

<head>
    <title>Login - App Cancel</title>
</head>

<body>
    <h2>Login</h2>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form action="<?= base_url('login') ?>" method="post">

        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>

</html>