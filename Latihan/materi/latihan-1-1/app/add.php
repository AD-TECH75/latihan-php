<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require '../template/bootstrap.php' ?>
</head>

<style>
    *,
    html,
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex-grow: 1;
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    main .card {
        width: 500px;
        max-width: 500px;
    }

    .card h1 {
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    form button {
        width: 100%;
    }
</style>

<body>
    <header>
        <?php require '../template/header.php' ?>
    </header>

    <main>
        <div class="card card-body">
            <h1>add-person</h1>
            <form action="../database/data.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">name</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="your name" required>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">age</label>
                    <input type="number" name="age" id="age" class="form-control" placeholder="your age" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="" selected hidden disabled>Open this select menu</option>
                        <option value="pelajar">pelajar</option>
                        <option value="bekerja">bekerja</option>
                        <option value="tidakbekerja">tidak bekerja</option>
                    </select>
                </div>

                <div class="mb3">
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <?php require '../template/footer.php' ?>
    </footer>
</body>

</html>