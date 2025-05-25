function calcular() {
    const anchura = parseFloat(document.getElementById('inputAnchura').value);
    const profundidad = parseFloat(document.getElementById('inputProfundidad').value);
    const altura = parseFloat(document.getElementById('inputAltura').value);

    if (isNaN(anchura) || isNaN(profundidad) || isNaN(altura)) {
        return;
    }

    const superficie = anchura * profundidad;
    const volumen = anchura * profundidad * altura;

    const superficieEnPies = superficie * 0.00107639;
    const volumenEnPies = volumen * 0.0000353147;

    document.getElementById("Superficie").innerText =
        `Superficie: ${superficie.toFixed(2)} cm² (${superficieEnPies.toFixed(2)} ft²)`;
    document.getElementById("Volumen").innerText =
        `Volumen: ${volumen.toFixed(2)} cm³ (${volumenEnPies.toFixed(2)} ft³)`;
}

calcular();
