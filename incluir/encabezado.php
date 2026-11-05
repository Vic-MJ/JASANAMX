<!DOCTYPE html>
<html lang="es">
<head>
    <script async src="https://www.googletagmanager.com/gtm.js?id=GTM-MWP8GKC5"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    </script>

    <script async src="https://www.googletagmanager.com/gtm.js?id=GTM-MTMWG36D"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) . ' | JASANA Hotel Wear' : 'JASANA Hotel Wear | Imagen y Tecnología Textil Hotelera'; ?></title>
    <meta name="description" content="Diseño, confección de uniformes de alta gama y tecnología textil para hoteles boutique, resorts y gastronomía.">
    <?php
    if (!isset($url_canonica)) {
        $ruta_uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        if ($ruta_uri === '/' || $ruta_uri === '/index.php' || empty($ruta_uri)) {
            $url_canonica = 'https://www.jasana.mx/';
        } else {
            $ruta_limpia = preg_replace('/\.php$/', '', $ruta_uri);
            $url_canonica = 'https://www.jasana.mx' . rtrim($ruta_limpia, '/');
        }
    }
    ?>
    <link rel="canonical" href="<?php echo htmlspecialchars($url_canonica); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Newsreader:ital,opsz,wght@0,6..72,400..700;1,6..72,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="preload" as="image" href="assets/imagenes/hero_slide_01.webp" type="image/webp" media="(min-width: 681px)" fetchpriority="high">
    <link rel="preload" as="image" href="assets/imagenes/hero_slide_01_movil.webp" type="image/webp" media="(max-width: 680px)" fetchpriority="high">
    <link rel="icon" type="image/png" href="assets/imagenes/imagotipo.png">
</head>
<body class="<?php echo isset($clase_cuerpo) ? htmlspecialchars($clase_cuerpo) : ''; ?>">
