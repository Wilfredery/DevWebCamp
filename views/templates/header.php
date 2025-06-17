<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">

            <?php if(isAuth()) {?>
                <a href="<?php echo is_admin() ? '/admin/dashboard' : '/finalizar-registro'; ?>" class="header__enlace">Administrar</a>

                <form method="POST" action="/logout" class="header__form">
                    <input type="submit" value="Cerrar sesion" class="header__submit">
                </form>

            <?php } else { ?>

                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/login" class="header__enlace">Iniciar sesion</a>

            <?php } ?>
        </nav>

        <div class="header__contenido">
            <a href="">
                <h1 class="header__logo">
                    &#60DevWebCamp />
                </h1>
            </a>
        </div>

        <p class="header__texto">Octubre 05/06/2023</p>
        <p class="header__texto header__texto--modalidad">En linea - Presencial</p>

        <a href="/registro" class="header__boton">Comprar pase</a>
    </div>
</header>

<div class="barra">
    <div class="barra__contenido">
        <a href="" class="barra__logo">
            <h2 class="barra__logo">
                &#60DevWebCamp />
            </h2>
        </a>

        <nav class="navegacion">
            <a href="/devwebcamp" class="navegacion__enlace <?php echo pagina_actual('/devwebcamp') ? 'navegacion__enlace--actual' : '' ?>">Evento</a>
            <a href="/paquetes" class="navegacion__enlace <?php echo pagina_actual('/paquetes') ? 'navegacion__enlace--actual' : '' ?>">Paquetes</a>
            <a href="/workshops-conferencias" class="navegacion__enlace <?php echo pagina_actual('/workshops-conferencias') ? 'navegacion__enlace--actual' : '' ?>">Workshop/Conferencias</a>
            <a href="/registro" class="navegacion__enlace <?php echo pagina_actual('/registro') ? 'navegacion__enlace--actual' : '' ?>">Comprar pase</a>
        </nav>
    </div>
</div>