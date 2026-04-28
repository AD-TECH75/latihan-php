<?php
declare(strict_types=1);
session_start();
if (isset($_SESSION['csrf'])) {
    header('location: ./dashboard.php');
    exit();
}
require_once __DIR__ . '/lib/csrf.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    *,
    html,
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        min-height: 100vh;
        background-color: bisque
    }

    main {
        width: 550px;
        height: fit-content;
        border-radius: 8px;
        padding: 15px;
        padding-bottom: 25px;
        background-color: white;
        box-shadow: 8px 8px 5px rgba(0, 0, 0, 0.5);
    }

    main h1 {
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    main p {
        text-align: center;
        color: red;
    }

    form .form-control {
        margin-bottom: 5px;
    }

    form label {
        margin-bottom: 3px;
        display: block;
    }

    form input {
        width: 100%;
        height: 30px;
        margin-bottom: 3px;
        display: block;
    }

    form .submit-control {
        margin-top: 10px;
    }

    form button {
        width: 100%;
        height: 30px;
        color: white;
        text-transform: uppercase;
        font-size: large;
        background-color: #0d6efd;
        cursor: pointer;
    }
</style>

<body>
    <main>
        <h1>selamat datang</h1>
        <?php if (isset($_SESSION['flash'])) : ?>
            <p><?= htmlspecialchars($_SESSION['flash']) ?></p>
        <?php endif; ?>
        <form action="./login.php" method="post">
            <div class="form-control">
                <label for="username">username</label>
                <input type="text" name="username" id="username" placeholder="username" required>
            </div>
            <div class="form-control">
                <label for="password">password</label>
                <input type="password" name="password" id="password" placeholder="password" required>
            </div>
            <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
            <div class="submit-control">
                <button type="submit" name="submit">submit</button>
            </div>
        </form>
    </main>
</body>

</html>