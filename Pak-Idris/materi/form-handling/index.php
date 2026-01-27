<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=form, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
</head>

<body>
    <h1>Registrasi Akun</h1>
    <form action="beranda.php" method="get">
        <div>
            <label for="nama" class="form-label">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="nama" />
        </div>
        <div class="mb-2">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" id="email" name="email" class="form-control" id="exampleFormControlInput1"
                placeholder="name@example.com" />
        </div>
        <div>
            <input type="submit" value="submit" class="btn btn-primary" />
        </div>
    </form>

    <form action="beranda.php" method="post" style="margin-top: 20px;">
        <h2>Login User</h2>
        <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="name@example.com" />
        </div>
        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="password" />
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</body>

</html>