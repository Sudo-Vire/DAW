<?php
define('NUMERO_A_ADIVINAR', 42);

if (isset($_POST['reset'])) {
    setcookie('intentos', 0, time() + 3600);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$intentos = isset($_COOKIE['intentos']) ? (int)$_COOKIE['intentos'] : 0;

if (isset($_POST['numero'])) {
    $intentos++;
    setcookie('intentos', $intentos, time() + 3600);
    $numeroIngresado = (int)$_POST['numero'];
    if ($numeroIngresado === NUMERO_A_ADIVINAR) {
        $mensaje = "¡Felicidades! Has adivinado el número en $intentos intentos.";
    } elseif ($numeroIngresado < NUMERO_A_ADIVINAR) {
        $mensaje = "El número es mayor.";
    } else {
        $mensaje = "El número es menor.";
    }
} else {
    $mensaje = "Introduce un número para empezar a jugar.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Adivinanza</title>
</head>
<body>
    <h1>¡Adivina el Número!</h1>
    <p>Intenta adivinar el número entre 1 y 100. Los intentos se guardan usando cookies.</p>
    <form method="post">
        <label for="numero">Tu número:</label>
        <input type="number" name="numero" id="numero" required>
        <button type="submit">Enviar</button>
        <button type="submit" name="reset">Reiniciar</button>
    </form>
    <p><strong>Mensaje:</strong> <?= htmlspecialchars($mensaje) ?></p>
    <p><strong>Intentos:</strong> <?= $intentos ?></p>
</body>
</html>
