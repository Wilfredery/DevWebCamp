<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo; ?></h2>
    <p class="devwebcamp__descripcion"><?php echo $descripcion; ?></p>

    <div class="devwebcamp__grid">
        <div class="devwebcamp__imagen">
            <picture>
                <source srcset="/build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="/build/img/sobre_devwebcamp.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="/build/img/sobre_devwebcamp.jpg" alt="Imagen sobre DevWebCamp">
            </picture>
        </div>

        <div class="devwebcamp__contenido">

            <p class="devwebcamp__texto">DevWebCamp es un evento único que reúne a los mejores expertos en desarrollo web para compartir sus conocimientos y experiencias.</p>

            <p class="devwebcamp__texto">DevWebCamp es un evento único que reúne a los mejores expertos en desarrollo web para compartir sus conocimientos y experiencias.</p>

        </div>
    </div>
</main>