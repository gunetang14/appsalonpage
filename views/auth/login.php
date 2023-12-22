<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" action="/login" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"
            autocomplete="off"
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password" 
            id="password"
            placeholder="Tu Password"
            name="password"
            autocomplete="off"
        />
    </div>
    <input type="submit" class="boton" value="Iniciar Sesión">


</form>
<div class="acciones">
    <a href="/signup">¿Aún no tienes cuenta? Crear una</a>
    <a href="/forgot">¿Olvidaste tu Password?</a>
</div>