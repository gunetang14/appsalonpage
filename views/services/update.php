<h1 class="nombre-pagina">Actualizar Servicios</h1>
<p class="descripcion-pagina">Llena los campos para actualizar el servicio</p>

<?php
    
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form method="POST" class="formulario">
    <?php
        include_once __DIR__ . '/form.php';
    ?>

    <input type="submit" class="boton" value="Actualizar Servicio">
</form>