<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Torneo Ecuestre</title>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: black;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    #numero-jinete {
        font-size: 45em;
        color: red;
        margin-bottom: 10px;
        margin-top: 10px;
    }

    #mensaje {
        background-color: #FFD700; /* Color dorado para la cinta */
        padding: 20px;
        font-size: 2em;
        color: black;
        border-radius: 10px;
        text-align: center;
        max-width: 80%;
        margin-bottom: 20px;
    }

    #jinetes-faltantes {
        background-color: white; /* Cambiamos el fondo a blanco */
        padding: 20px;
        font-size: 1.5em;
        color: black;
        border-radius: 10px;
        text-align: center;
        max-width: 80%;
    }
</style>
</head>
<body>
<div id="numero-jinete">1</div>
<div id="mensaje">Mensaje de ejemplo</div>
<div id="jinetes-faltantes">
    <h2>Se prepara para ingresar:</h2>
    <ul>
        <li>Jinete 2</li>
        <li>Jinete 3</li>
        <li>Jinete 4</li>
        <!-- Puedes agregar más jinetes aquí -->
    </ul>
    <h2>Estar Listo:</h2>
    <ul>
        <li>Jinete 5</li>
        <li>Jinete 6</li>
        <li>Jinete 7</li>
        <!-- Puedes agregar más jinetes aquí -->
    </ul>    
    
</div>

<script>
    // JavaScript para actualizar el número de jinete de forma aleatoria entre 1 y 999
    function actualizarNumeroJinete() {
        var numero = Math.floor(Math.random() * 999) + 1;
        document.getElementById("numero-jinete").innerText = numero;
    }

    // Actualizar el número de jinete cada 3 segundos (puedes ajustar este valor según tus necesidades)
    setInterval(actualizarNumeroJinete, 3000);
</script>
</body>
</html>
