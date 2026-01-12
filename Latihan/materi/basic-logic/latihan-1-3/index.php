<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <main>
        <form action="proccess.php" method="post">
        <input type="number" name="number1" required>
        <select name="operator" required>
            <option value="plus">+</option>
            <option value="minus">-</option>
            <option value="multiplied">x</option>
            <option value="devide">/</option>
        </select>
        <input type="number" name="number2" required>
        <button type="submit" name="hitung">Hitung</button>
    </form>
    </main>
</body>

</html>