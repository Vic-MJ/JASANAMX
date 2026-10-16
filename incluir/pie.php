<footer class="pie-pagina">
    <div class="contenedor pie-contenedor">
        <div class="pie-columna-marca">
            <a href="./" class="pie-logotipo-enlace" aria-label="JASANA Hotel Wear">
                <img src="assets/imagenes/logo_oscuro.png" alt="JASANA Hotel Wear" class="pie-logotipo" loading="lazy">
            </a>
        </div>

        <nav class="pie-navegacion" aria-label="Navegación de pie de página">
            <ul class="pie-lista-enlaces">
                <li><a href="./#inicio">Inicio</a></li>
                <li><a href="./#lineas">Líneas</a></li>
                <li><a href="https://tienda.jasana.mx/shop">Tienda</a></li>
                <li><a href="./#nosotros">Nosotros</a></li>
                <li><a href="./#contacto">Contacto</a></li>
            </ul>
        </nav>

        <div class="pie-redes-sociales">
            <a href="https://tienda.jasana.mx/website/social/instagram" target="_blank" rel="noopener noreferrer" class="pie-enlace-red" aria-label="Instagram">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
            </a>
            <a href="https://tienda.jasana.mx/website/social/linkedin" target="_blank" rel="noopener noreferrer" class="pie-enlace-red" aria-label="LinkedIn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                    <rect x="2" y="9" width="4" height="12"></rect>
                    <circle cx="4" cy="4" r="2"></circle>
                </svg>
            </a>
            <a href="https://tienda.jasana.mx/website/social/facebook" target="_blank" rel="noopener noreferrer" class="pie-enlace-red" aria-label="Facebook">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                </svg>
            </a>
        </div>

        <div class="pie-legales">
            <span class="pie-derechos">&copy; <?php echo date('Y'); ?> JASANA Hotel Wear.</span>
            <div class="pie-enlaces-legales">
                <a href="#privacidad" data-abrir-privacidad>Aviso de privacidad</a>
                <span class="separador-legal">|</span>
                <a href="#terminos">Términos</a>
            </div>
        </div>
    </div>
</footer>

<?php require_once __DIR__ . '/modal_cotizacion.php'; ?>
<?php require_once __DIR__ . '/modal_info_lineas.php'; ?>
<?php require_once __DIR__ . '/modal_privacidad.php'; ?>

<script src="assets/js/principal.js"></script>
</body>
</html>
