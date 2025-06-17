<main class="agenda">

    <h2 class="agenda__heading"><?php echo $titulo; ?></h2>
    <p class="agenda__descripcion"><?php echo $descripcion; ?></p>

    <div class="eventos">
        <h3 class="eventos__heading">&lt;Conferencias /></h3>
        <p class="eventos__fecha">Viernes 5 de Octubre</p>

        <div class="eventos__listado slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($eventos['conferencias_viernes'] as $evento): ?>

                    <?php include __DIR__ . '../../templates/evento.php'; ?>

                <?php endforeach; ?>
            </div>
            <!-- creacion del boton para desplazar el slider -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <p class="eventos__fecha">Sabado 6 de Octubre</p>

        <div class="eventos__listado slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($eventos['conferencias_sabados'] as $evento): ?>

                    <?php include __DIR__ . '../../templates/evento.php'; ?>

                <?php endforeach; ?>
            </div>
            <!-- creacion del boton para desplazar el slider -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <div class="eventos eventos--workshops">
        <h3 class="eventos__heading">&lt;Workshops /></h3>
        <p class="eventos__fecha">Viernes 5 de Octubre</p>

        <div class="eventos__listado slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($eventos['workshops_viernes'] as $evento): ?>

                    <?php include __DIR__ . '../../templates/evento.php'; ?>

                <?php endforeach; ?>
            </div>
            <!-- creacion del boton para desplazar el slider -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <p class="eventos__fecha">Sabado 6 de Octubre</p>

        <div class="eventos__listado slider swiper">
            <div class="swiper-wrapper">
                <?php foreach($eventos['workshops_sabados'] as $evento): ?>

                    <?php include __DIR__ . '../../templates/evento.php'; ?>

                <?php endforeach; ?>
            </div>
            <!-- creacion del boton para desplazar el slider -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</main>