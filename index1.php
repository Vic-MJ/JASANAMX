<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página en Reestructuración | JASANA Hotel Wear</title>
    <meta name="description" content="Página en reestructuración. Volveremos pronto. Contáctanos en ventas@uniformesjasana.com o al 3331657220.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Newsreader:ital,opsz,wght@0,6..72,300..700;1,6..72,300..700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/imagenes/imagotipo.png">

    <style>
        :root {
            --bg-principal: #0D0F0E;
            --bg-tarjeta: rgba(24, 27, 25, 0.75);
            --borde-tarjeta: rgba(219, 206, 193, 0.12);
            --oro-jasana: #C4A482;<
            --oro-brillo: #DFC5A9;
            --texto-principal: #F8F6F2;
            --texto-secundario: #A6A39C;
            --texto-atenuado: #73706A;
            --fuente-sans: "Instrument Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --fuente-serif: "Newsreader", Georgia, serif;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            min-height: 100%;
        }

        body {
            font-family: var(--fuente-sans);
            background-color: var(--bg-principal);
            color: var(--texto-principal);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .fondo-escena {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .fondo-imagen {
            position: absolute;
            inset: 0;
            background-image: url('assets/imagenes/hero_slide_01.webp');
            background-size: cover;
            background-position: center 30%;
            opacity: 0.16;
            filter: grayscale(40%) contrast(1.15);
            transform: scale(1.05);
            animation: zoomLento 30s infinite alternate ease-in-out;
        }

        @keyframes zoomLento {
            0% { transform: scale(1.03) translateY(0); }
            100% { transform: scale(1.07) translateY(-10px); }
        }

        .fondo-gradiente {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(ellipse 80% 50% at 50% 15%, rgba(196, 164, 130, 0.18) 0%, transparent 70%),
                radial-gradient(circle at 80% 85%, rgba(112, 122, 90, 0.08) 0%, transparent 50%),
                linear-gradient(180deg, rgba(13, 15, 14, 0.82) 0%, rgba(13, 15, 14, 0.95) 55%, #0D0F0E 100%);
        }

        .fondo-malla {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(219, 206, 193, 0.08) 1px, transparent 1px);
            background-size: 32px 32px;
            opacity: 0.4;
        }

        .pagina-envoltorio {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            max-width: 1180px;
            width: 100%;
            margin: 0 auto;
            padding: clamp(28px, 4vw, 48px) clamp(20px, 4vw, 40px);
        }

        .cabecera-reestructuracion {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(219, 206, 193, 0.1);
        }

        .marca-enlace {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            transition: opacity 0.25s ease;
        }

        .marca-enlace:hover {
            opacity: 0.85;
        }

        .marca-logotipo {
            height: clamp(32px, 4.5vw, 42px);
            width: auto;
            object-fit: contain;
        }

        .etiqueta-estado {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 16px;
            background-color: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(196, 164, 130, 0.28);
            border-radius: 999px;
            font-size: 11px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--oro-brillo);
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        .punto-pulso {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background-color: #D4AF37;
            box-shadow: 0 0 10px #D4AF37;
            animation: pulso 2s infinite ease-in-out;
        }

        @keyframes pulso {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(0.85); }
        }

        .contenido-central {
            margin: auto 0;
            padding: clamp(40px, 7vh, 80px) 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .subtitulo-editorial {
            font-size: 11px;
            letter-spacing: 0.32em;
            text-transform: uppercase;
            color: var(--oro-jasana);
            font-weight: 600;
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .subtitulo-editorial::before,
        .subtitulo-editorial::after {
            content: "";
            display: inline-block;
            width: 28px;
            height: 1px;
            background-color: rgba(196, 164, 130, 0.35);
        }

        .titular-principal {
            font-family: var(--fuente-serif);
            font-size: clamp(36px, 6.2vw, 72px);
            font-weight: 300;
            line-height: 1.12;
            letter-spacing: -0.01em;
            color: var(--texto-principal);
            max-width: 860px;
            margin-bottom: 24px;
        }

        .titular-principal em {
            font-style: italic;
            font-family: var(--fuente-serif);
            color: var(--oro-brillo);
            font-weight: 400;
            display: block;
        }

        .descripcion-editorial {
            font-size: clamp(15px, 1.7vw, 18px);
            color: var(--texto-secundario);
            max-width: 620px;
            margin: 0 auto clamp(36px, 5vh, 52px) auto;
            font-weight: 400;
            line-height: 1.75;
        }

        .tarjeta-contactos {
            background: var(--bg-tarjeta);
            border: 1px solid var(--borde-tarjeta);
            border-radius: 16px;
            padding: clamp(28px, 4vw, 40px);
            max-width: 740px;
            width: 100%;
            margin: 0 auto;
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
            position: relative;
        }

        .tarjeta-linea-acento {
            position: absolute;
            top: 0;
            left: 36px;
            right: 36px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--oro-jasana), transparent);
        }

        .tarjeta-contacto-encabezado {
            font-size: 11px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--oro-jasana);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .cuadricula-canales {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .tarjeta-canal {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 18px 22px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(219, 206, 193, 0.1);
            border-radius: 10px;
            text-decoration: none;
            color: var(--texto-principal);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            text-align: left;
        }

        .tarjeta-canal:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: var(--oro-jasana);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
        }

        .tarjeta-canal--destacado {
            background: rgba(196, 164, 130, 0.08);
            border-color: rgba(196, 164, 130, 0.25);
        }

        .tarjeta-canal--destacado:hover {
            background: rgba(196, 164, 130, 0.14);
            border-color: var(--oro-brillo);
        }

        .canal-icono {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(196, 164, 130, 0.12);
            color: var(--oro-brillo);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s ease;
        }

        .tarjeta-canal:hover .canal-icono {
            background: var(--oro-jasana);
            color: #0E100F;
            transform: scale(1.06);
        }

        .canal-info {
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .canal-etiqueta {
            font-size: 11px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--texto-atenuado);
            font-weight: 500;
            margin-bottom: 3px;
        }

        .canal-valor {
            font-size: clamp(14px, 1.4vw, 15px);
            font-weight: 600;
            color: var(--texto-principal);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .enlace-tienda-bloque {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid rgba(219, 206, 193, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
            color: var(--texto-secundario);
        }

        .enlace-tienda-link {
            color: var(--oro-brillo);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: color 0.2s ease;
        }

        .enlace-tienda-link:hover {
            color: #FFFFFF;
            text-decoration: underline;
        }

        .pie-reestructuracion {
            padding-top: 24px;
            border-top: 1px solid rgba(219, 206, 193, 0.1);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            font-size: 12px;
            color: var(--texto-atenuado);
        }

        .pie-redes {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .pie-red-enlace {
            color: var(--texto-secundario);
            text-decoration: none;
            transition: color 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .pie-red-enlace:hover {
            color: var(--oro-brillo);
        }

        @media (max-width: 680px) {
            .cuadricula-canales {
                grid-template-columns: 1fr;
            }

            .cabecera-reestructuracion {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .pie-reestructuracion {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="fondo-escena" aria-hidden="true">
        <div class="fondo-imagen"></div>
        <div class="fondo-gradiente"></div>
        <div class="fondo-malla"></div>
    </div>

    <div class="pagina-envoltorio">
        
        <header class="cabecera-reestructuracion">
            <a href="index1.php" class="marca-enlace" aria-label="JASANA Hotel Wear">
                <img src="assets/imagenes/logo_blanco.webp" alt="JASANA Hotel Wear" class="marca-logotipo">
            </a>
            
            <div class="etiqueta-estado">
                <span class="punto-pulso"></span>
                <span>En Reestructuración</span>
            </div>
        </header>

        <main class="contenido-central">
            
            <span class="subtitulo-editorial">Hotels &amp; Resorts &bull; Sastrería y Blancos</span>

            <h1 class="titular-principal">
                Página en reestructuración.
                <em>Volveremos pronto.</em>
            </h1>

            <p class="descripcion-editorial">
                Estamos renovando nuestra plataforma digital para brindarte una mejor experiencia. Nuestro equipo continúa atendiendo solicitudes y proyectos a través de nuestros canales directos:
            </p>

            <div class="tarjeta-contactos">
                <div class="tarjeta-linea-acento"></div>

                <div class="tarjeta-contacto-encabezado">
                    Canales de Atención Directa
                </div>

                <div class="cuadricula-canales">
                    <a href="mailto:ventas@uniformesjasana.com?subject=Consulta%20desde%20JASANA%20Web" class="tarjeta-canal tarjeta-canal--destacado" id="canal-correo" title="Enviar correo a ventas@uniformesjasana.com">
                        <div class="canal-icono">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                        </div>
                        <div class="canal-info">
                            <span class="canal-etiqueta">Correo electrónico</span>
                            <span class="canal-valor">ventas@uniformesjasana.com</span>
                        </div>
                    </a>

                    <a href="https://wa.me/523331657220?text=Hola,%20deseo%20información%20sobre%20JASANA" target="_blank" rel="noopener noreferrer" class="tarjeta-canal tarjeta-canal--destacado" id="canal-telefono" title="Contactar por WhatsApp o llamar">
                        <div class="canal-icono">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="canal-info">
                            <span class="canal-etiqueta">Teléfono / WhatsApp</span>
                            <span class="canal-valor">3331657220</span>
                        </div>
                    </a>
                </div>

                <div class="enlace-tienda-bloque">
                    <span>¿Buscas catálogo o compras en línea?</span>
                    <a href="https://tienda.jasana.mx/shop" target="_blank" rel="noopener noreferrer" class="enlace-tienda-link">
                        Visita nuestra Tienda Oficial &rarr;
                    </a>
                </div>
            </div>

        </main>

        <footer class="pie-reestructuracion">
            <div>
                &copy; <?php echo date('Y'); ?> JASANA Hotel Wear &bull; Todos los derechos reservados.
            </div>

            <div class="pie-redes">
                <a href="https://tienda.jasana.mx/website/social/instagram" target="_blank" rel="noopener noreferrer" class="pie-red-enlace" aria-label="Instagram">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </a>
                <a href="https://tienda.jasana.mx/website/social/linkedin" target="_blank" rel="noopener noreferrer" class="pie-red-enlace" aria-label="LinkedIn">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                        <rect x="2" y="9" width="4" height="12"></rect>
                        <circle cx="4" cy="4" r="2"></circle>
                    </svg>
                </a>
                <a href="https://sm-inovoo-jasana.odoo.com/website/social/facebook" target="_blank" rel="noopener noreferrer" class="pie-red-enlace" aria-label="Facebook">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                </a>
            </div>
        </footer>

    </div>

</body>
</html>
