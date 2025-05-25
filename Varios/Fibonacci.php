<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fibonacci</title>
</head>
<body>
    <h1>Secuencia de Fibonacci</h1>
    <form method="post">
        <label for="cantidad">Cantidad de números:</label>
        <input type="number" id="cantidad" name="cantidad" required>
        <button type="submit">Generar</button>
    </form>
    <hr>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cantidad = intval($_POST["cantidad"]);
        $a = 0;
        $b = 1;
        echo "<h2>Secuencia de Fibonacci:</h2>";
        echo "<ul>";
        for ($i = 0; $i < $cantidad; $i++) {
            echo "<li>$a</li>";
            $temp = $a + $b;
            $a = $b;
            $b = $temp;
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
