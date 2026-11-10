<?php
$titulo_pagina = "Aviso de Privacidad";
$clase_cuerpo = "pagina-privacidad";

require_once dirname(__DIR__) . '/incluir/encabezado.php';
require_once dirname(__DIR__) . '/incluir/navegacion.php';
?>

<main class="seccion seccion--privacidad-pagina" style="padding-top: 140px; padding-bottom: 90px; background-color: var(--jasana-blanco-papel);">
    <div class="contenedor" style="max-width: 860px;">
        <div class="privacidad-cabecera" style="margin-bottom: 32px;">
            <div class="privacidad-membrete">
                <span class="subtitulo-etiqueta">DOCUMENTO LEGAL OFICIAL</span>
                <span class="privacidad-fecha-actualizacion">Última actualización: Mayo de 2025</span>
            </div>
            <h1 class="privacidad-titulo" style="font-size: clamp(30px, 3.5vw, 44px);">Aviso de Privacidad Integral</h1>
            <div class="privacidad-empresa-meta">
                <strong>CORPORATIVO TEXTIL JSN, S. DE R.L. DE C.V.</strong> &bull; Marca Comercial: <strong>UNIFORMES JASANA&reg;</strong> (Registro IMPI: 818341) &bull; RFC: <strong>CTJ201123HI2</strong>
            </div>
        </div>

        <div class="privacidad-cuerpo-lectura" style="max-height: none; overflow: visible; padding-right: 0;">
            <?php
            $htmlModal = file_get_contents(dirname(__DIR__) . '/incluir/modales/modal_privacidad.php');
            if (preg_match('/<div class="privacidad-cuerpo-lectura">(.*?)<\/div>\s*<div class="privacidad-acciones-modal">/s', $htmlModal, $coincidencias)) {
                echo $coincidencias[1];
            }
            ?>
        </div>

        <div class="privacidad-acciones-modal" style="margin-top: 36px;">
            <a href="./" class="boton-cta boton-cta--solido">
                &larr; VOLVER AL INICIO
            </a>
            <a href="assets/documentos/AVISO_DE_PRIVACIDAD_JASANA.pdf" download="AVISO_DE_PRIVACIDAD_JASANA.pdf" class="enlace-descarga-pdf-opcional">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Descargar copia oficial en PDF
            </a>
        </div>
    </div>
</main>

<?php require_once dirname(__DIR__) . '/incluir/pie.php'; ?>
