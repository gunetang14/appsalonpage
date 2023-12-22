<div class="barra"> 
    <p>Hola: <?php echo $nombre ?? ''; ?></p>
    <a href="/logout" class="boton">Cerrar Sesión</a>
</div>

<?php if(isset($_SESSION['admin'])) : ?>

    <div class="barra-servicios">
        <a class="boton" href="/admin">Ver Citas</a>
        <a class="boton" href="/services">Ver Servicios</a>
        <a class="boton" href="/services/create">Nuevo Servicios</a>
    </div>

<?php endif; ?>