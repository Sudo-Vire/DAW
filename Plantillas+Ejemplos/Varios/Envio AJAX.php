<?php
if (isset($_GET['tabla'])) {
    class Respuesta {
        public $datos;
        public $limite;
        public $tipo;
    }

    header('Content-Type: application/json');

    $tipo = $_GET['tabla'];
    $json = new Respuesta();

    switch ($tipo) {
        case 'names':
            $json->datos = ["James", "Emily", "Michael", "Sarah", "William", "Olivia", "David", "Jessica ", "Robert", "Hannah", "Émilie", "Julien", "Claire", "Antoine", "Sophie"];
            break;
        case 'ages':
            $json->datos = ["1-19-2020","2-12-2022","3-17-2025","1-5-2025","2-2-2020","9-22-2025","10-12-2021","5-11-2021","12-5-2025","1-29-2024","2-21-2022","7-30-2025","4-8-2025","5-2-2024","7-1-2025"];
            break;
        case 'address':
            $json->datos = ["221B Baker Street, Marylebone","10 Downing Street, Westminster","45 King’s Road, Chelsea","66 Fleet Street, Temple","52 The Mall, St. James's","56 Oxford Street, Soho","7 Westbourne Grove, Notting Hill","120 New Bond Street, Mayfair","34 Carnaby Street, Soho","134 Sloane Street, Chelsea","Champ de Mars, 5 ","Rue de Rivoli","6 Parvis Notre-Dame - Pl.","Place Charles de Gaulle,","35 Rue du Chevalier de la Barre"];
            break;
    }

    $json->limite = isset($_GET['limite']) ? intval($_GET['limite']) : count($json->datos);
    $json->tipo = $tipo;

    echo json_encode($json);
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>GD2C4</title>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const body = document.body;

                const menu = document.createElement('div');
                menu.style.width = '154px';
                menu.style.height = '298px';
                menu.style.padding = '3px';
                menu.style.backgroundColor = '#ccc';
                menu.style.float = 'left';
                body.appendChild(menu);

                const cont_elementos = document.createElement('div');
                cont_elementos.style.width = '306px';
                cont_elementos.style.height = '290px';
                cont_elementos.style.padding = '7px';
                cont_elementos.style.backgroundColor = '#ccc';
                cont_elementos.style.marginLeft = '10px';
                cont_elementos.style.float = 'left';
                cont_elementos.style.fontSize = '16.25px';
                cont_elementos.innerText = 'pulsa para tener datos';
                cont_elementos.style.overflowWrap = 'break-word';
                cont_elementos.style.wordBreak = 'break-all';
                body.appendChild(cont_elementos);

                const cont_objeto = document.createElement('div');
                cont_objeto.style.width = '476px';
                cont_objeto.style.height = '184px';
                cont_objeto.style.padding = '8px'
                cont_objeto.style.backgroundColor = '#ccc';
                cont_objeto.style.marginLeft = '10px';
                cont_objeto.style.float = 'left';
                cont_objeto.innerText = 'envio\n\nrecepcion';
                cont_objeto.style.overflow = 'none';
                body.appendChild(cont_objeto);

                const botones = [
                    {tipo: 'names', limite: 15},
                    {tipo: 'ages', limite: 15},
                    {tipo: 'address', limite: 15},
                    {tipo: 'names', limite: 2},
                    {tipo: 'ages', limite: 3},
                    {tipo: 'address', limite: 5},
                    {tipo: 'names', limite: 10},
                    {tipo: 'ages', limite: 12},
                    {tipo: 'address', limite: 14}
                ];

                botones.forEach(boton => {
                    const button = document.createElement('button');
                    if (boton.limite === 15) {
                        button.innerText = `get all ${boton.tipo}`
                    } else {
                        button.innerText = `get ${boton.limite} ${boton.tipo}`;
                    }
                    button.style.display = 'block';
                    button.style.margin = '5px';
                    button.style.width = '145px';
                    button.style.height = '9.25%';
                    button.style.border = 'none';
                    button.style.textAlign = 'left';
                    button.style.fontSize = '16px';
                    button.style.backgroundColor = 'white';
                    button.onmouseover = () => { 
                        button.style.backgroundColor = 'yellow';
                        button.style.cursor = 'cell';
                    }
                    button.onmouseout = () => button.style.backgroundColor = 'white';
                    button.onclick = () => {
                        button.style.backgroundColor = 'pink';
                        getData(boton.tipo, cont_elementos, cont_objeto, boton.limite);
                    };
                    menu.appendChild(button);
                });

                function getData(tipo, cont_elementos, cont_objeto, limite) {
                    const ajax = new XMLHttpRequest();
                    ajax.open('GET', `?tabla=${tipo}&limite=${limite}`, true);
                    cont_objeto.innerText = '';
                    ajax.onload = function() {
                        if (ajax.status === 200) {
                            const datos = JSON.parse(ajax.responseText);
                            let salida = '';
                            for (let i = 0; i < limite && i < datos.datos.length; i++) {
                                salida += (i + 1) + '. ' + datos.datos[i] + `<br>`;
                            }
                            cont_elementos.innerHTML = salida;
                            cont_objeto.innerHTML = `?opcion={"tabla": "${tipo}", "limite": ${limite}}<br><br> {"datos": ${JSON.stringify(datos.datos)}, "limite": "${limite}", "tipo": "${tipo}"}`;
                        }
                    };
                    ajax.send();
                }

            });
        </script>
    </head>
    <body>
    </body>
</html>
