<h1 class="nombre-pagina">Olvidé Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form class="formulario" action="/forgot" method="POST">

    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu Email"
            autocomplete="off"
        />
    </div>
    <input type="submit" value="Enviar Instrucciones" class="boton">

</form>

<div class="acciones">
    <a href="/login">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/signup">¿Aún no tienes cuenta? Crear una</a>
</div>