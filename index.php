<?php
$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
$segmentos = array_values(array_filter(explode('/', $uriPath)));
$slug = !empty($segmentos) ? preg_replace('/\.php$/', '', end($segmentos)) : '';

$rutasPaginas = [
    'signature'        => __DIR__ . '/paginas/signature.php',
    'essentials'       => __DIR__ . '/paginas/essentials.php',
    'bath_bed'         => __DIR__ . '/paginas/bath_bed.php',
    'cycles_plantilla' => __DIR__ . '/paginas/cycles_plantilla.php',
    'privacidad'       => __DIR__ . '/paginas/privacidad.php',
    'linea_signature'  => __DIR__ . '/paginas/signature.php',
    'linea_essentials' => __DIR__ . '/paginas/essentials.php',
    'linea_bath_bed'   => __DIR__ . '/paginas/bath_bed.php'
];

if (!empty($slug) && isset($rutasPaginas[$slug])) {
    require_once $rutasPaginas[$slug];
    exit;
}

$titulo_pagina = "Inicio";
$clase_cuerpo = "pagina-inicio";

require_once __DIR__ . '/incluir/encabezado.php';
require_once __DIR__ . '/incluir/navegacion.php';
require_once __DIR__ . '/incluir/secciones/hero_deslizador.php';
require_once __DIR__ . '/incluir/secciones/nuestras_lineas.php';
require_once __DIR__ . '/incluir/secciones/quienes_somos.php';
require_once __DIR__ . '/incluir/secciones/enfoque_valores.php';
require_once __DIR__ . '/incluir/secciones/cyclesapp.php';
require_once __DIR__ . '/incluir/secciones/diferenciador.php';
require_once __DIR__ . '/incluir/secciones/calidad_innovacion.php';
require_once __DIR__ . '/incluir/secciones/cta_final.php';
require_once __DIR__ . '/incluir/pie.php';
