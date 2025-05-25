<?php
if (isset($_POST['reset'])) {
    setcookie('intentos', 0, time() + 3600*24*30);
    setcookie('intentos_totales', 0, time() + 3600*24*30);
    setcookie('puntos', 0, time() + 3600*24*30);
    setcookie('numero_secreto', rand(1, 100), time() + 3600*24*30);
    setcookie('min_actual', 1, time() + 3600*24*30);
    setcookie('max_actual', 100, time() + 3600*24*30);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$numeroSecreto = isset($_COOKIE['numero_secreto']) ? (int)$_COOKIE['numero_secreto'] : rand(1, 100);
$intentos = isset($_COOKIE['intentos']) ? (int)$_COOKIE['intentos'] : 0;
$intentosTotales = isset($_COOKIE['intentos_totales']) ? (int)$_COOKIE['intentos_totales'] : 0;
$puntos = isset($_COOKIE['puntos']) ? (int)$_COOKIE['puntos'] : 0;
$min = isset($_COOKIE['min_actual']) ? (int)$_COOKIE['min_actual'] : 1;
$max = isset($_COOKIE['max_actual']) ? (int)$_COOKIE['max_actual'] : 100;

if (isset($_POST['numero'])) {
    $numeroIngresado = (int)$_POST['numero'];
    $intentos++;
    $intentosTotales++;
    setcookie('intentos', $intentos, time() + 3600*24*30);
    setcookie('intentos_totales', $intentosTotales, time() + 3600*24*30);

    if ($numeroIngresado === $numeroSecreto) {
        $puntos++;
        setcookie('puntos', $puntos, time() + 3600*24*30);
        $mensaje = "¡Felicidades! Has adivinado el número <b>$numeroSecreto</b> en $intentos intentos. ¡Se ha generado un nuevo número para ti!";
        $intentos = 0;
        setcookie('intentos', 0, time() + 3600*24*30);
        $numeroSecreto = rand(1, 100);
        setcookie('numero_secreto', $numeroSecreto, time() + 3600*24*30);
        $min = 1;
        $max = 100;
        setcookie('min_actual', $min, time() + 3600*24*30);
        setcookie('max_actual', $max, time() + 3600*24*30);
    } elseif ($numeroIngresado < $numeroSecreto) {
        $mensaje = "El número es mayor.";
        $min = max($numeroIngresado+1, $min);
        setcookie('min_actual', $min, time() + 3600*24*30);
    } else {
        $mensaje = "El número es menor.";
        $max = min($numeroIngresado-1, $max);
        setcookie('max_actual', $max, time() + 3600*24*30);
    }
} else {
    $mensaje = "Introduce un número para empezar a jugar.";
}

$media_intentos = ($puntos > 0) ? number_format($intentosTotales / $puntos, 2) : '-';

include 'NS.html';
