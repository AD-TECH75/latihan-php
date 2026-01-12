<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <form action="result.php" method="post">
            <input type="number" name="number1" id="number2">
            <input type="number" name="number2" id="number2">
            <select name="operation" id="operation">
                <option value="" disabled hidden>Choose the operator</option>
                <option value="plus">+</option>
                <option value="minus">-</option>
                <option value="multiplied">x</option>
                <option value="devide">/</option>
            </select>
            <button type="submit" name="submit" id="submit">submit</button>
        </form>
    </main>
</body>
</html>