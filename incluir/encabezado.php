<!DOCTYPE html>
<html lang="es">
<head>
    <script async src="https://www.googletagmanager.com/gtm.js?id=GTM-MHV8SPM9"></script>
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
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_MX">
    <meta property="og:site_name" content="JASANA Hotel Wear">
    <meta property="og:title" content="<?php echo isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) . ' | JASANA Hotel Wear' : 'JASANA Hotel Wear | Imagen y Tecnología Textil Hotelera'; ?>">
    <meta property="og:description" content="Diseño, confección de uniformes de alta gama y tecnología textil para hoteles boutique, resorts y gastronomía.">
    <meta property="og:url" content="<?php echo htmlspecialchars($url_canonica); ?>">
    <meta property="og:image" content="https://www.jasana.mx/assets/imagenes/hero_slide_01.webp">
    <meta property="og:image:width" content="1920">
    <meta property="og:image:height" content="1080">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) . ' | JASANA Hotel Wear' : 'JASANA Hotel Wear | Imagen y Tecnología Textil Hotelera'; ?>">
    <meta name="twitter:description" content="Diseño, confección de uniformes de alta gama y tecnología textil para hoteles boutique, resorts y gastronomía.">
    <meta name="twitter:image" content="https://www.jasana.mx/assets/imagenes/hero_slide_01.webp">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Newsreader:ital,opsz,wght@0,6..72,400..700;1,6..72,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.min.css?v=<?php echo file_exists(__DIR__ . '/../assets/css/estilos.min.css') ? filemtime(__DIR__ . '/../assets/css/estilos.min.css') : '2.0'; ?>">
    <link rel="preload" as="image" href="assets/imagenes/hero_slide_01.webp" type="image/webp" media="(min-width: 681px)" fetchpriority="high">
    <link rel="preload" as="image" href="assets/imagenes/hero_slide_01_movil.webp" type="image/webp" media="(max-width: 680px)" fetchpriority="high">
    <link rel="icon" type="image/png" href="assets/imagenes/imagotipo.png">
</head>
<body class="<?php echo isset($clase_cuerpo) ? htmlspecialchars($clase_cuerpo) : ''; ?>">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHV8SPM9" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MTMWG36D" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
