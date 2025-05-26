function dibujarGrafica() {
    const canvas = document.getElementById('graficaCanvas');
    const formula = document.getElementById('inputFormula').value || '2*x^3-3*x^2-7.5*x+4';
    const Escala = parseFloat(document.getElementById('inputEscala').value) || 100;
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    ctx.strokeStyle = '#84847b';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(0, 250);
    ctx.lineTo(500, 250);
    ctx.moveTo(250, 0);
    ctx.lineTo(250, 500);
    ctx.stroke();

    ctx.lineWidth = 1;
    for (let i = -Math.floor(canvas.width / (Escala / 10)); i <= Math.floor(canvas.width / (Escala / 10)); i++) {
        const PosX = 250 + i * Escala / 10;
        ctx.beginPath();
        ctx.moveTo(PosX, 245);
        ctx.lineTo(PosX, 255);
        ctx.stroke();
    }
    for (let i = -Math.floor(canvas.height / (Escala / 10)); i <= Math.floor(canvas.height / (Escala / 10)); i++) {
        const PosY = 250 - i * Escala / 10;
        ctx.beginPath();
        ctx.moveTo(245, PosY);
        ctx.lineTo(255, PosY);
        ctx.stroke();
    }

    ctx.strokeStyle = '#ff0000';
    ctx.lineWidth = 2;
    ctx.beginPath();
    let UltimaX, UltimaY;
    for (let x = -1000; x <= 1000; x += 0.2) {
        let evalFormula;
        try {
            evalFormula = formula.replace(/x/g, `(${x})`).replace(/\^/g, '**');
            var y = eval(evalFormula);
        } catch (e) {
            continue;
        }
        const X = 250 + x * Escala / 10;
        const Y = 250 - y * Escala / 10;
        if (x === -1000) {
            ctx.moveTo(X, Y);
        } else {
            ctx.lineTo(X, Y);
        }
        if (Y < 0 || Y > canvas.height) {
            const InterseccionY = Y < 0 ? 0 : canvas.height;
            const Pendiente = (Y - UltimaY) / (X - UltimaX);
            const InterseccionX = UltimaX + (InterseccionY - UltimaY) / Pendiente;
            ctx.lineTo(InterseccionX, InterseccionY);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(InterseccionX, InterseccionY);
        }
        UltimaX = X;
        UltimaY = Y;
    }
    ctx.stroke();

    ctx.fillStyle = '#000000';
    ctx.font = '16px Arial';
    ctx.fillText(`y = ${formula}`, 10, canvas.height - 10);
    ctx.fillText('x', canvas.width - 30, 265);
    ctx.fillText('y', 235, 30);
}

document.getElementById('inputFormula').addEventListener('input', dibujarGrafica);
document.getElementById('inputEscala').addEventListener('input', dibujarGrafica);
window.onload = dibujarGrafica;