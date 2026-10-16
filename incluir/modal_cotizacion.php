<div id="modal-cotizar" class="modal-cotizacion" aria-hidden="true" data-linea-activa="Signature">
    <div class="modal-fondo" data-cerrar-modal></div>
    <div class="modal-contenedor">
        <!-- Línea sutil de acento superior -->
        <div class="modal-linea-acento" aria-hidden="true"></div>

        <button type="button" class="modal-cerrar" data-cerrar-modal aria-label="Cerrar ventana">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <div class="modal-cabecera">
            <span class="subtitulo-etiqueta">JASANA HOTEL WEAR</span>
            <h3 class="modal-titulo">Cotiza tu Proyecto</h3>
            <p class="modal-descripcion">Diseñamos soluciones textiles personalizadas que elevan la presencia y operación de tu hotel.</p>
        </div>

        <form id="formulario-cotizacion" class="formulario-cotizacion" action="procesar_cotizacion.php" method="POST">
            <!-- Selector tipográfico minimalista de línea -->
            <div class="selector-lineas-bloque">
                <div class="selector-lineas-tabs" role="tablist" aria-label="Selección de línea de interés">
                    <button type="button" class="tab-linea activa" data-linea="Signature" role="tab" aria-selected="true">Signature</button>
                    <button type="button" class="tab-linea" data-linea="Essentials" role="tab" aria-selected="false">Essentials</button>
                    <button type="button" class="tab-linea" data-linea="Bath & Bed" role="tab" aria-selected="false">Bath &amp; Bed</button>
                    <button type="button" class="tab-linea" data-linea="Cycles" role="tab" aria-selected="false">Cycles RFID</button>
                    <button type="button" class="tab-linea" data-linea="Integral" role="tab" aria-selected="false">Proyecto Integral</button>
                </div>

                <!-- Select nativo para formularios y accesibilidad -->
                <select id="campo-linea" name="linea" class="control-linea-oculto" aria-label="Línea de interés">
                    <option value="Signature">JASANA Signature (Alta personalización)</option>
                    <option value="Essentials">JASANA Essentials (Colecciones listas)</option>
                    <option value="Bath & Bed">Bath &amp; Bed (Blancos y toallas)</option>
                    <option value="Cycles">CYCLES (Tecnología RFID)</option>
                    <option value="Integral">Proyecto integral completo</option>
                </select>

                <!-- Retoque sutil: micro-frase que describe la línea con elegancia y sin ruido -->
                <p class="nota-linea-sutil" id="nota-linea-sutil">
                    Sastrería de autor y alta personalización para recepción, concierge y directivos.
                </p>
            </div>

            <!-- Fila: Nombre completo -->
            <div class="campo-grupo">
                <label for="campo-nombre" class="etiqueta-campo">Nombre completo</label>
                <input type="text" id="campo-nombre" name="nombre" class="control-entrada" required placeholder="Ej. Carlos Mendoza">
            </div>

            <!-- Fila: Hotel y Ubicación -->
            <div class="campo-fila">
                <div class="campo-grupo">
                    <label for="campo-hotel" class="etiqueta-campo">Hotel o Empresa</label>
                    <input type="text" id="campo-hotel" name="hotel" class="control-entrada" required placeholder="Ej. Hotel Boutique San Miguel">
                </div>
                <div class="campo-grupo">
                    <label for="campo-ciudad" class="etiqueta-campo">Ciudad / Ubicación</label>
                    <input type="text" id="campo-ciudad" name="ciudad" class="control-entrada" placeholder="Ej. Riviera Maya, Q. Roo">
                </div>
            </div>

            <!-- Fila: Correo y Teléfono -->
            <div class="campo-fila">
                <div class="campo-grupo">
                    <label for="campo-correo" class="etiqueta-campo">Correo electrónico</label>
                    <input type="email" id="campo-correo" name="correo" class="control-entrada" required placeholder="correo@tu-hotel.com">
                </div>
                <div class="campo-grupo">
                    <label for="campo-telefono" class="etiqueta-campo">Teléfono / WhatsApp</label>
                    <input type="tel" id="campo-telefono" name="telefono" class="control-entrada" required placeholder="+52 55 1234 5678">
                </div>
            </div>

            <!-- Fila: Volumen contextual -->
            <div class="campo-grupo">
                <label for="campo-volumen" class="etiqueta-campo" id="etiqueta-volumen">Colaboradores a uniformar</label>
                <div class="select-envoltorio">
                    <select id="campo-volumen" name="volumen" class="control-entrada control-seleccion">
                        <option value="1-25">1 a 25 personas / habitaciones</option>
                        <option value="26-75">26 a 75 personas / habitaciones</option>
                        <option value="76-150">76 a 150 personas / habitaciones</option>
                        <option value="150+">Más de 150 personas / habitaciones</option>
                    </select>
                    <span class="select-flecha" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Fila: Detalles del proyecto -->
            <div class="campo-grupo">
                <label for="campo-mensaje" class="etiqueta-campo">Detalles del proyecto</label>
                <textarea id="campo-mensaje" name="mensaje" rows="3" class="control-entrada control-area" placeholder="Cuéntanos sobre tus requerimientos o fecha estimada..."></textarea>
            </div>

            <!-- Botón de Envío y nota de servicio -->
            <div class="bloque-accion-modal">
                <button type="submit" class="boton-cta boton-cta--solido boton-cta--completo boton-envio-minimal" id="boton-envio-cotizacion">
                    <span id="texto-boton-envio">SOLICITAR PROPUESTA</span>
                </button>
                <p class="pie-nota-confidencialidad">Atención personalizada en menos de 24 horas hábiles &bull; Muestrario físico disponible</p>
            </div>

            <!-- Mensaje de éxito minimalista -->
            <div id="mensaje-exito" class="mensaje-exito-minimal" style="display: none;">
                <p class="mensaje-exito-texto-minimal" id="mensaje-exito-texto">
                    Tu solicitud ha sido recibida con éxito. Un asesor de JASANA se comunicará contigo a la brevedad.
                </p>
            </div>
        </form>
    </div>
</div>