<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevWebCamp - <?php echo $titulo; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin="" defer></script>
</head>
<body>
    <?php 
        include_once __DIR__ .'/templates/header.php';
        echo $contenido;
        include_once __DIR__ .'/templates/footer.php'; 
    ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="/build/js/main.min.js" defer></script>

    <script>
        AOS.init({
            offset: 0,
            anchorPlacement: "top-bottom"
        });
    
        // Función debounce
        function debounce(func, delay = 100) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }
    
        // Llamada a AOS.refresh() con debounce
        const refreshAOSDebounced = debounce(() => {
            AOS.refresh();
        }, 150); // Puedes ajustar el delay si lo necesitas
    
        // Añadir listener a todas las imágenes lazy
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('img[loading="lazy"]').forEach((img) => {
                if (img.complete) {
                    // Ya estaba cargada
                    refreshAOSDebounced();
                } else {
                    img.addEventListener('load', refreshAOSDebounced);
                }
            });
        });
    </script>
</body>
</html>