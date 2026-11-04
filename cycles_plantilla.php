<?php
$titulo_pagina = "CYCLES - Control Textil Inteligente RFID";
$clase_cuerpo = "pagina-plantilla-cycles";

require_once __DIR__ . '/incluir/encabezado.php';
require_once __DIR__ . '/incluir/navegacion.php';
?>

<section class="seccion-plantilla-hero">
    <div class="plantilla-hero-fondo" style="background-image: url('assets/imagenes/hero_slide_03.webp');"></div>
    <div class="plantilla-hero-velo"></div>
    <div class="contenedor plantilla-hero-contenedor">
        <div class="bloque-titular-plantilla">
            <span class="insignia-plantilla-destacada">PLANTILLA EN DESARROLLO &bull; TECNOLOGÍA TEXTIL</span>
            <h1 class="titular-plantilla">CYCLES <span class="titular-enfasis">Textil Inteligente</span></h1>
            <p class="bajada-plantilla">
                Plataforma de gestión de inventarios y trazabilidad con chips RFID grado hospitalario integrados en uniformes y blancos. Monitorea ciclos de lavado, vida útil y ubicación en tiempo real.
            </p>
            <div class="grupo-botones-hero">
                <a href="#simulador" class="boton-cta boton-cta--blanco">VER SIMULADOR RFID</a>
                <a href="./" class="enlace-explorar">&larr; VOLVER AL INICIO</a>
            </div>
        </div>
    </div>
</section>

<section class="seccion seccion--plantilla-detalles">
    <div class="contenedor">
        <div class="cabecera-seccion cabecera-seccion--centrada">
            <span class="subtitulo-etiqueta">ARQUITECTURA DE LA SOLUCIÓN</span>
            <h2 class="titulo-editorial">Optimización operativa<br><span class="titulo-editorial--enfasis">para la industria hotelera.</span></h2>
            <p class="parrafo-descripcion">
                Esta sección se encuentra en fase de plantilla mientras se completa la integración con la suite de software hotelero JASANA Cloud.
            </p>
        </div>

        <div class="cuadricula-pilares-cycles">
            <div class="tarjeta-pilar-cycles">
                <div class="icono-pilar-cycles">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"></path>
                        <path d="M15.54 8.46a5 5 0 0 1 0 7.08M8.46 8.46a5 5 0 0 0 0 7.08"></path>
                    </svg>
                </div>
                <h3 class="titulo-pilar">Tag RFID Termoresistente</h3>
                <p class="descripcion-pilar">Microchips de alta resistencia química y térmica capaces de resistir más de 200 ciclos de lavado industrial y planchado a alta presión.</p>
            </div>

            <div class="tarjeta-pilar-cycles">
                <div class="icono-pilar-cycles">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </div>
                <h3 class="titulo-pilar">Conteo Masivo en Segundos</h3>
                <p class="descripcion-pilar">Lectura simultánea de hasta 300 prendas por segundo sin necesidad de contacto visual directo ni apertura de bolsas de lavandería.</p>
            </div>

            <div class="tarjeta-pilar-cycles">
                <div class="icono-pilar-cycles">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3 class="titulo-pilar">Cero Extravíos y Mermas</h3>
                <p class="descripcion-pilar">Identificación exacta de asignación por departamento, colaborador y habitación, reduciendo las mermas operativas en más de un 80%.</p>
            </div>

            <div class="tarjeta-pilar-cycles">
                <div class="icono-pilar-cycles">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                </div>
                <h3 class="titulo-pilar">Panel de Control &amp; Reportes</h3>
                <p class="descripcion-pilar">Métricas en tiempo real sobre rotación de prendas, proyecciones de reposición y auditoría de costos de lavandería por área.</p>
            </div>
        </div>
    </div>
</section>

<section id="simulador" class="seccion seccion--simulador">
    <div class="contenedor">
        <div class="panel-simulador">
            <div class="panel-simulador-cabecera">
                <div>
                    <span class="subtitulo-etiqueta">DEMO INTERACTIVA (PLANTILLA)</span>
                    <h3 class="panel-simulador-titulo">Simulador de Lectura RFID</h3>
                </div>
                <button type="button" class="boton-cta boton-cta--solido" id="boton-simular-escaneo">
                    <span>EJECUTAR ESCANEO RFID</span>
                </button>
            </div>

            <div class="panel-simulador-metricas">
                <div class="metrica-caja">
                    <span class="metrica-etiqueta">Prendas Detectadas</span>
                    <span class="metrica-valor" id="metrica-prendas">148</span>
                </div>
                <div class="metrica-caja">
                    <span class="metrica-etiqueta">Tiempo de Lectura</span>
                    <span class="metrica-valor" id="metrica-tiempo">0.42 s</span>
                </div>
                <div class="metrica-caja">
                    <span class="metrica-etiqueta">Estado de Inventario</span>
                    <span class="metrica-valor metrica-valor--exito" id="metrica-estado">100% Verificado</span>
                </div>
                <div class="metrica-caja">
                    <span class="metrica-etiqueta">Ciclos Promedio</span>
                    <span class="metrica-valor">34 / 150</span>
                </div>
            </div>

            <div class="tabla-contenedor">
                <table class="tabla-prendas">
                    <thead>
                        <tr>
                            <th>EPC / ID Tag</th>
                            <th>Tipo de Prenda</th>
                            <th>Línea</th>
                            <th>Asignación / Área</th>
                            <th>Ciclos de Lavado</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo-tabla-prendas">
                        <tr>
                            <td><code>JHW-E280-9941</code></td>
                            <td>Saco Ejecutivo Dama Borgoña</td>
                            <td>JASANA Signature</td>
                            <td>Recepción / Front Desk</td>
                            <td>18 ciclos</td>
                            <td><span class="insignia-estado estado-activo">En Servicio</span></td>
                        </tr>
                        <tr>
                            <td><code>JHW-E280-9942</code></td>
                            <td>Camisa Resort Cuello Mao Arena</td>
                            <td>JASANA Essentials</td>
                            <td>Alimentos y Bebidas</td>
                            <td>42 ciclos</td>
                            <td><span class="insignia-estado estado-activo">En Servicio</span></td>
                        </tr>
                        <tr>
                            <td><code>JHW-E280-9943</code></td>
                            <td>Toalla Alberca Premium 700g</td>
                            <td>Bath &amp; Bed</td>
                            <td>Alberca &amp; Spa</td>
                            <td>85 ciclos</td>
                            <td><span class="insignia-estado estado-lavanderia">En Lavandería</span></td>
                        </tr>
                        <tr>
                            <td><code>JHW-E280-9944</code></td>
                            <td>Filipina Chef Executive Negra</td>
                            <td>JASANA Signature</td>
                            <td>Cocina Principal</td>
                            <td>29 ciclos</td>
                            <td><span class="insignia-estado estado-activo">En Servicio</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<section class="seccion seccion--cta-final">
    <div class="cta-fondo-imagen" style="background-image: url('assets/imagenes/cta_fondo.webp');"></div>
    <div class="cta-capa-oscura"></div>
    <div class="contenedor contenedor--reducido cta-contenido-relativo">
        <h2 class="titulo-cta-final">
            ¿Deseas implementar CYCLES<br><span class="titulo-editorial--enfasis">en tu hotel?</span>
        </h2>
        <div class="bloque-boton-cta">
            <a href="#cotizar" class="boton-cta boton-cta--blanco boton-cta--grande" data-abrir-modal="modal-cotizar" data-linea-previa="Cycles">
                <span>SOLICITAR DEMO PRIVADA</span>
                <span class="flecha-cta">&rarr;</span>
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/incluir/pie.php'; ?>
