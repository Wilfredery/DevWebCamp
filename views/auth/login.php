
<main class="auth">


    <h1 class="auth__heading"> <?php echo $titulo; ?> </h1>

    <p class="auth__texto"> Inicia sesion en DevWebCamp </p>

    <form action="" class="formulario">

        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>

            <input type="email"
            type="email"
            class="formulario__input"
            name="email"
            placeholder="Tu email"
            id="email"
            >
        </div>

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>

            <input type="password"
            type="password"
            class="formulario__input"
            name="password"
            placeholder="Tu password"
            id="password"
            >
        </div>

        <input type="submit" 
        class="formulario__submit" 
        value="Iniciar Sesion"
        >
    
    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿No tienes cuenta? Crear una</a>
        <a href="/olvide" class="acciones__enlace">Olvide mi password</a>
    </div>

</main>