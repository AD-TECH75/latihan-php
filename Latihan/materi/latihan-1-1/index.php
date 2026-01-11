<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require './template/bootstrap.php' ?>
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
    }

    .view {
        height: 80vh;
        max-height: 80vh;
        overflow-y: auto;
    }

    .view .card-head {
        position: sticky;
        top: 0;
        z-index: 999;
    }
</style>

<body>
    <header>
        <?php require './template/header.php' ?>
    </header>
    
    <main>
        <div class="view card p-4 m-3 shadow">
            <div class="card-head d-flex mb-3">
                <button class="p-1 border-1 bg-light">
                    filter
                    <i class="bi bi-funnel-fill"></i>
                </button>
                <button class="ms-auto p-1 rounded border-1  bg-primary">
                    <a href="./app/add.php" class="text-white text-decoration-none">
                        add
                        <i class="bi bi-plus"></i>
                    </a>
                </button>
            </div>
            
            <div class="card-container">
                <?php require './view/view.php' ?>
            </div>
        </div>
    </main>
    
    <footer>
        <?php require './template/footer.php' ?>
    </footer>
</body>

</html>