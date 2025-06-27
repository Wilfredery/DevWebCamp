<main class="registro">
    <h1 class="registro__heading"><?php echo $titulo; ?></h1>
    <p class="registro__descripcion"><?php echo $descripcion; ?></p>

    <div class="paquetes__grid">
        <div data-aos="<?php aos_animacion(); ?>" class="paquete">

            <h3 class="paquete__nombre">Pase gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
            </ul>

            <p class="paquete__precio">$0</p>

            <form action="/finalizarRegistro/gratis" method="POST">
                <input type="submit" class="paquetes__submit" type="submit" value="Seleccionar pase gratis">
            </form>

        </div>

        <div data-aos="<?php aos_animacion(); ?>" class="paquete">

            <h3 class="paquete__nombre">Pase presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a grabaciones</li>
                <li class="paquete__elemento">Camisa del evento</li>
                <li class="paquete__elemento">Comida y bebida</li>
            </ul>

            <p class="paquete__precio">$199</p>
        </div>

        <div data-aos="<?php aos_animacion(); ?>" class="paquete">

            <h3 class="paquete__nombre">Pase virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a grabaciones</li>
            </ul>

            <p class="paquete__precio">$49</p>
        </div>

    </div>
</main>