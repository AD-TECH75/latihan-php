<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <main>
        <form action="page.php" method="post" class="p-4">
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" name="username" class="form-control" placeholder="username" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" name="email" class="form-control" placeholder="example@example.com" required>
            </div>

            <div class="mb-3">
                <label for="nomor" class="form-label">nomor</label>
                <input type="number" name="nomor" class="form-control" placeholder="08xxxxxxxxxx" required>
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-primary">submit</button>
            </div>
        </form>
    </main>
</body>

</html>