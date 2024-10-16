<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Parroquial</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="build/css/app.css">
</head>

<body>
    <div class="contenedor-app">
        <!-- Mostrar la imagen de fondo solo si $mostrarImagen es true, ELIMINA ESTO SI NO FUNCIONA, EXCEPTO: <div id="imagenFondo" class="imagen"></div> -->
        <?php if (isset($mostrarImagen) && $mostrarImagen): ?>
            <div id="imagenFondo" class="imagen"></div>
        <?php endif; ?>

        <div class="app">
            <img class="logo" src="build/img/logo2.png" alt="Clínica">
            <img class="logo2" src="build/img/susalud.png" alt="Susalud">
            <?php echo $contenido; ?>
        </div>
    </div>

    
    <?php
    echo $script ?? '';
    ?>
</body>

</html>