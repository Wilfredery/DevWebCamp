<div class="pagina">
    <h2 class="pagina__heading"><?php echo $titulo ?></h2>
    <p class="pagina__descripcion"><?php echo $descripcion ?></p>

    <div class="eventos-registro">
        <main class="eventos-registro__listado">
            <h3 class="eventos-registro__heading--conferencias">&lt;Conferencias /></h3>
            <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

            <div class="eventos-registro__grid">
                <?php foreach($eventos['conferencias_viernes'] as $evento) { ?>

                    <?php include __DIR__ . '/evento.php'; ?>

                <?php } ?>
            </div>
        </main>
    </div>

    <aside class="registro">
        <h2 class="registro__heading">Tu registro</h2>
    </aside>
</div>