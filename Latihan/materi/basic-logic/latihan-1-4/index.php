<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="proccess.php" method="post">
        <input type="number" name="number1">
        <select name="operator">
            <option value="plus">+</option>
            <option value="minus">-</option>
            <option value="multiplied">x</option>
            <option value="devide">/</option>
        </select>
        <input type="number" name="number2">
        <button type="submit" name="submit">submit</button>
    </form>
</body>
</html>