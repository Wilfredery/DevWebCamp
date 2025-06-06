<main class="agenda">

    <h2 class="agenda__heading"><?php echo $titulo; ?></h2>
    <p class="agenda__descripcion"><?php echo $descripcion; ?></p>

    <div class="eventos">
        <h3 class="eventos__heading">&lt;Conferencias /></h3>
        <p class="eventos__fecha">Viernes 5 de Octubre</p>

        <div class="eventos__listado">
            <?php foreach($eventos['conferencias_viernes'] as $evento): ?>
                <div class="evento">
                    <p class="evento__hora"><?php echo $evento->hora->hora; ?></p>

                    <div class="evento__informacion">
                        <h4 class="evento__nombre"><?php echo $evento->nombre; ?>

                        <div>
                            <p class="evento__informacion"><?php echo $evento->descripcion; ?></p>
                        </div>

                        <div class="evento__autor-info">
                            <picture>

                                <source srcset="img/speakers/<?php echo $evento->ponente->imagen;?>.webp" type="image/webp">

                                <source srcset="img/speakers/<?php echo $evento->ponente->imagen;?>.png" type="image/png">

                                <img src="img/speakers/<?php echo $evento->ponente->imagen;?>.png" alt="Imagen Evento">
                            </picture>

                            <p class="evento__autor-nombre"><?php echo $evento->ponente->nombre . " " . $evento->ponente->apellido;?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <p class="eventos__fecha">Sabado 6 de Octubre</p>

        <div class="eventos__listado">
            <?php foreach($eventos['conferencias_sabado'] as $evento): ?>
                <div class="evento">
                    <p class="evento__hora"><?php echo $evento->hora->hora; ?></p>
                    
                    <!-- <h4 class="evento__titulo"><?php echo $evento->titulo; ?></h4> // 
                    // <p class="evento__ponente"><?php echo $evento->ponente->nombre; ?></p> -->
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="eventos eventos--workshops">
        <h3 class="eventos__heading">&lt;Workshops /></h3>
        <p class="eventos__fecha">Viernes 5 de Octubre</p>

        <div class="eventos__listado">
            <?php foreach($eventos['workshops_viernes'] as $evento): ?>
                <div class="evento">
                    <p class="evento__hora"><?php echo $evento->hora->hora; ?></p>
                    <!-- // 
                    // <p class="evento__ponente"><?php echo $evento->ponente->nombre; ?></p> -->
                </div>
            <?php endforeach; ?>
        </div>

        <p class="eventos__fecha">Sabado 6 de Octubre</p>

        <div class="eventos__listado">
            <?php foreach($eventos['workshops_sabado'] as $evento): ?>
                <div class="evento">
                    <p class="evento__hora"><?php echo $evento->hora->hora; ?></p>
                    
                    <!-- <h4 class="evento__titulo"><?php echo $evento->titulo; ?></h4>// 
                    // <p class="evento__ponente"><?php echo $evento->ponente->nombre; ?></p> -->
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>