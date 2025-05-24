<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $r = isset($_POST["r"]) ? intval($_POST["r"]) : 0;
    $g = isset($_POST["g"]) ? intval($_POST["g"]) : 0;
    $b = isset($_POST["b"]) ? intval($_POST["b"]) : 0;

    // Asegurar valores entre 0 y 255
    $r = max(0, min(255, $r));
    $g = max(0, min(255, $g));
    $b = max(0, min(255, $b));

    // Convertir a formato hexadecimal
    $hexColor = sprintf("%02X%02X%02X", $r, $g, $b);

    echo $hexColor;
    exit; // Evitar contenido adicional en la respuesta AJAX
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selector de Color RGB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .slider-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }
        input[type="range"] {
            width: 150px;
            margin: 0 10px;
        }
        .color-box {
            width: 150px;
            height: 30px;
            display: inline-block;
            margin: 5px;
            border: 1px solid #000;
        }
        .color-display {
            width: 400px;
            height: 50px;
            margin: 10px auto;
            border: 2px solid black;
            background-color: #000;
        }
        .hex-display {
            width: 100px;
            height: 30px;
            border: 1px solid black;
            margin: auto;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            line-height: 30px;
        }
    </style>
</head>
<body>

    <h2>Selecciona los valores RGB</h2>

    <div class="slider-container">
        <input type="range" id="red" min="0" max="255" value="0">
        <input type="range" id="green" min="0" max="255" value="0">
        <input type="range" id="blue" min="0" max="255" value="0">
    </div>

    <div>
        <div id="colorRed" class="color-box" style="background-color: rgb(0,0,0);"></div>
        <div id="colorGreen" class="color-box" style="background-color: rgb(0,0,0);"></div>
        <div id="colorBlue" class="color-box" style="background-color: rgb(0,0,0);"></div>
    </div>

    <div id="finalColor" class="color-display"></div>
    <div class="hex-display" id="hexValue">#000000</div>

    <script>
        function updateColors() {
            let r = document.getElementById("red").value;
            let g = document.getElementById("green").value;
            let b = document.getElementById("blue").value;

            document.getElementById("colorRed").style.backgroundColor = `rgb(${r},0,0)`;
            document.getElementById("colorGreen").style.backgroundColor = `rgb(0,${g},0)`;
            document.getElementById("colorBlue").style.backgroundColor = `rgb(0,0,${b})`;

            // Enviar datos al servidor con AJAX
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let hexColor = xhr.responseText;
                    document.getElementById("finalColor").style.backgroundColor = `#${hexColor}`;
                    document.getElementById("hexValue").innerText = `#${hexColor}`;
                }
            };
            xhr.send(`r=${r}&g=${g}&b=${b}`);
        }

        document.getElementById("red").addEventListener("input", updateColors);
        document.getElementById("green").addEventListener("input", updateColors);
        document.getElementById("blue").addEventListener("input", updateColors);
    </script>

</body>
</html>
