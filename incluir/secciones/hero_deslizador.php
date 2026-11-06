<section id="inicio" class="seccion-hero" aria-label="Presentación principal">
    <div class="deslizador-hero" id="deslizador-hero">
        <div class="diapositiva diapositiva--activa" data-indice="0" aria-label="Los mejores aliados para la imagen de tu Hotel">
            <div class="diapositiva-imagen" style="background-image: url('assets/imagenes/hero_slide_01.webp');"></div>
            <div class="diapositiva-velo diapositiva-velo--derecha"></div>
            <div class="contenedor contenedor-hero">
                <div class="bloque-titular bloque-titular--derecha">
                    <h1 class="titular-hero">
                        <span class="titular-recto">Los mejores aliados<br>para la imagen</span><br>
                        <span class="titular-enfasis titular-linea-destacada">de tu Hotel</span>
                    </h1>
                    <p class="bajada-hero-editorial">Uniformes · Blancos · Tecnología textil</p>
                    <div class="grupo-acciones-hero">
                        <a href="#lineas" class="boton-cta-hero">CONOCE JASANA &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="diapositiva" data-indice="1" aria-label="Diseños personalizados y Telas con tecnología">
            <div class="diapositiva-imagen" style="background-image: url('assets/imagenes/hero_slide_02.webp');"></div>
            <div class="diapositiva-velo diapositiva-velo--izquierda"></div>
            <div class="contenedor contenedor-hero">
                <div class="bloque-titular bloque-titular--izquierda">
                    <h2 class="titular-hero">
                        <span class="titular-recto">Diseños personalizados<br>y </span><span class="titular-enfasis titular-linea-destacada">Telas con tecnología</span>
                    </h2>
                    <p class="bajada-hero-editorial">Diseño y desempeño textil de alto rendimiento.</p>
                    <div class="grupo-acciones-hero">
                        <a href="#lineas" class="boton-cta-hero">CONOCE JASANA &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="diapositiva" data-indice="2" aria-label="CYCLES App: Control Textil Inteligente">
            <div class="diapositiva-imagen" style="background-image: url('assets/imagenes/hero_slide_03.webp');"></div>
            <div class="diapositiva-velo diapositiva-velo--izquierda"></div>
            <div class="contenedor contenedor-hero">
                <div class="bloque-titular bloque-titular--izquierda">
                    <h2 class="titular-hero">
                        <span class="titular-recto">CYCLES App:<br></span><span class="titular-enfasis titular-linea-destacada">Control Textil Inteligente</span>
                    </h2>
                    <p class="bajada-hero-editorial">Tecnología RFID aplicada a la operación hotelera.</p>
                    <div class="grupo-acciones-hero">
                        <a href="#cycles" class="boton-cta-hero">CONOCE CYCLES &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="controles-deslizador">
        <div class="contenedor controles-contenedor">
            <div class="indicadores-editorial" id="indicadores-editorial" role="group" aria-label="Controles del carrusel">
                <!-- Tooltip informativo tras clics continuos -->
                <div class="tooltip-pausa-hero" id="tooltip-pausa-hero" role="tooltip" aria-hidden="true">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <rect x="5" y="4" width="4" height="16" rx="1"></rect>
                        <rect x="15" y="4" width="4" height="16" rx="1"></rect>
                    </svg>
                    <span>Para pausar, mantén presionado aquí</span>
                </div>

                <!-- Insignia visual sutil cuando se mantiene presionado -->
                <div class="insignia-pausa-hero" id="insignia-pausa-hero" role="status" aria-hidden="true">
                    <span class="icono-pausa-barras" aria-hidden="true">
                        <span></span><span></span>
                    </span>
                    <span>Pausado</span>
                </div>

                <button type="button" class="indicador-item activo" data-diapositiva="0" aria-label="Ver diapositiva 1">
                    <span class="indicador-numero">01</span>
                    <span class="indicador-linea"><span class="indicador-progreso"></span></span>
                </button>
                <button type="button" class="indicador-item" data-diapositiva="1" aria-label="Ver diapositiva 2">
                    <span class="indicador-numero">02</span>
                    <span class="indicador-linea"><span class="indicador-progreso"></span></span>
                </button>
                <button type="button" class="indicador-item" data-diapositiva="2" aria-label="Ver diapositiva 3">
                    <span class="indicador-numero">03</span>
                    <span class="indicador-linea"><span class="indicador-progreso"></span></span>
                </button>
            </div>
        </div>
    </div>
</section>
