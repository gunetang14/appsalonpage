<h1 class="nombre-pagina">Crear Servicios</h1>
<p class="descripcion-pagina">Llena los campos para añadir un servicio</p>

<?php
    
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/services/create" method="POST" class="formulario">
    <?php
        include_once __DIR__ . '/form.php';
    ?>

    <input type="submit" class="boton" value="Guardar Servicio">
</form>