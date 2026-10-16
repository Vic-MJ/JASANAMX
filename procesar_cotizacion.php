<?php
/**
 * JASANA HOTELS & RESORTS - Procesador de Cotizaciones
 * Envío de solicitudes vía SMTP SSL (mail.uniformesjasana.com:465)
 */

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Método no permitido.'
    ]);
    exit;
}

require_once __DIR__ . '/incluir/servicio_correo.php';

// Sanitización y captura de campos
$nombre = isset($_POST['nombre']) ? trim(strip_tags($_POST['nombre'])) : '';
$hotel = isset($_POST['hotel']) ? trim(strip_tags($_POST['hotel'])) : '';
$ciudad = isset($_POST['ciudad']) ? trim(strip_tags($_POST['ciudad'])) : '';
$correo = isset($_POST['correo']) ? trim(filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL)) : '';
$telefono = isset($_POST['telefono']) ? trim(strip_tags($_POST['telefono'])) : '';
$linea = isset($_POST['linea']) ? trim(strip_tags($_POST['linea'])) : 'Signature';
$volumen = isset($_POST['volumen']) ? trim(strip_tags($_POST['volumen'])) : '';
$mensaje = isset($_POST['mensaje']) ? trim(strip_tags($_POST['mensaje'])) : '';
$etiquetas = isset($_POST['etiquetas']) ? trim(strip_tags($_POST['etiquetas'])) : '';

// Validación de campos obligatorios
if (empty($nombre) || empty($hotel) || empty($correo) || empty($telefono)) {
    http_response_code(400);
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Por favor completa todos los campos requeridos (Nombre, Hotel, Correo y Teléfono).'
    ]);
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Por favor ingresa un correo electrónico válido.'
    ]);
    exit;
}

// Mapeo descriptivo para volumen y líneas
$etiquetasVolumen = [
    '1-25' => '1 a 25 personas / habitaciones',
    '26-75' => '26 a 75 personas / habitaciones',
    '76-150' => '76 a 150 personas / habitaciones',
    '150+' => 'Más de 150 personas / habitaciones'
];
$volumenTexto = isset($etiquetasVolumen[$volumen]) ? $etiquetasVolumen[$volumen] : ($volumen ?: 'No especificado');

$nombresLineas = [
    'Signature' => 'JASANA Signature (Sastrería de autor y alta personalización)',
    'Essentials' => 'JASANA Essentials (Colecciones listas de alta durabilidad)',
    'Bath & Bed' => 'JASANA Bath & Bed (Blancos, sábanas y toallas)',
    'Cycles' => 'CYCLES RFID (Control Textil Inteligente)',
    'Integral' => 'Proyecto Integral Completo'
];
$lineaTexto = isset($nombresLineas[$linea]) ? $nombresLineas[$linea] : $linea;

// Colores de acento por línea para el correo
$coloresLinea = [
    'Signature' => '#9B8D7F',
    'Essentials' => '#707A5A',
    'Bath & Bed' => '#4E6B7C',
    'Cycles' => '#0E8388',
    'Integral' => '#8E98A0'
];
$colorAcento = isset($coloresLinea[$linea]) ? $coloresLinea[$linea] : '#C4A482';

$fechaHora = date('d/m/Y H:i:s');
$asunto = "Nueva Cotización: $hotel — $nombre ($linea)";

// Destinatario para pruebas según solicitud del usuario
$destinatarios = [JASANA_MAIL_DESTINATARIO_PRUEBAS];

// Construcción del correo en HTML con diseño editorial de lujo
$cuerpoHtml = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Solicitud de Cotización</title>
</head>
<body style="margin: 0; padding: 0; background-color: #F6F4F0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #181A18; -webkit-font-smoothing: antialiased;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #F6F4F0; padding: 36px 12px;">
  <tr>
    <td align="center">
      <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width: 620px; background-color: #FFFFFF; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 24px rgba(24, 26, 24, 0.08); border: 1px solid #ECE8E1;">
        
        <!-- Cabecera Editorial JASANA -->
        <tr>
          <td style="background-color: #181A18; padding: 32px 36px; text-align: left;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td>
                  <span style="font-size: 20px; letter-spacing: 0.22em; font-weight: 700; color: #FFFDF9; display: block;">JASANA</span>
                  <span style="font-size: 10px; letter-spacing: 0.28em; color: rgba(255, 252, 249, 0.6); text-transform: uppercase;">Hotels &amp; Resorts &bull; Uniformes y Blancos</span>
                </td>
                <td align="right">
                  <span style="display: inline-block; padding: 5px 12px; background-color: rgba(255, 255, 255, 0.08); border: 1px solid {$colorAcento}; border-radius: 999px; font-size: 11px; letter-spacing: 0.08em; color: #FFFDF9; text-transform: uppercase; font-weight: 600;">
                    {$linea}
                  </span>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- Barra de acento sutil -->
        <tr>
          <td style="height: 3px; background-color: {$colorAcento}; font-size: 0; line-height: 0;">&nbsp;</td>
        </tr>

        <!-- Contenido Principal -->
        <tr>
          <td style="padding: 36px 36px 28px 36px;">
            <h1 style="margin: 0 0 6px 0; font-size: 22px; font-weight: 600; color: #181A18; letter-spacing: -0.01em;">
              Nueva Solicitud de Propuesta
            </h1>
            <p style="margin: 0 0 24px 0; font-size: 13px; color: #737373;">
              Recibida el {$fechaHora} a través del sitio web oficial.
            </p>

            <!-- Tabla de Datos -->
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; margin-bottom: 24px;">
              <tr>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #8A8884; width: 38%; font-weight: 600;">Hotel / Empresa</td>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 15px; font-weight: 600; color: #181A18;">{$hotel}</td>
              </tr>
              <tr>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #8A8884; font-weight: 600;">Contacto</td>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 14px; color: #181A18;">{$nombre}</td>
              </tr>
              <tr>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #8A8884; font-weight: 600;">Ciudad / Ubicación</td>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 14px; color: #181A18;">{$ciudad}</td>
              </tr>
              <tr>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #8A8884; font-weight: 600;">Correo Electrónico</td>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 14px; font-weight: 600; color: #181A18;">
                  <a href="mailto:{$correo}" style="color: #181A18; text-decoration: underline;">{$correo}</a>
                </td>
              </tr>
              <tr>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #8A8884; font-weight: 600;">Teléfono / WhatsApp</td>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 14px; font-weight: 600; color: #181A18;">
                  <a href="tel:{$telefono}" style="color: #181A18; text-decoration: none;">{$telefono}</a>
                </td>
              </tr>
              <tr>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #8A8884; font-weight: 600;">Línea de Interés</td>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 14px; font-weight: 600; color: #181A18;">{$lineaTexto}</td>
              </tr>
              <tr>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #8A8884; font-weight: 600;">Volumen Estimado</td>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 14px; color: #181A18;">{$volumenTexto}</td>
              </tr>
HTML;

if (!empty($etiquetas)) {
    $cuerpoHtml .= <<<HTML
              <tr>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #8A8884; font-weight: 600;">Enfoque / Requerimientos</td>
                <td style="padding: 12px 0; border-bottom: 1px solid #F0EEE9; font-size: 14px; color: #181A18;">{$etiquetas}</td>
              </tr>
HTML;
}

$mensajeHtml = !empty($mensaje) ? nl2br(htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8')) : '<em style="color: #999;">Sin comentarios adicionales</em>';

$cuerpoHtml .= <<<HTML
            </table>

            <!-- Caja de Mensaje / Detalles -->
            <div style="background-color: #FBF9F6; border-left: 3px solid {$colorAcento}; padding: 18px 20px; border-radius: 4px; margin-bottom: 26px;">
              <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: #8A8884; font-weight: 600; display: block; margin-bottom: 6px;">Detalles del proyecto / Notas</span>
              <p style="margin: 0; font-size: 14px; line-height: 1.55; color: #2C2C2C;">
                {$mensajeHtml}
              </p>
            </div>

            <!-- Botón de acción rápida -->
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align="center" style="padding: 10px 0 20px 0;">
                  <a href="mailto:{$correo}?subject=Re:%20Cotizaci%C3%B3n%20JASANA%20-%20{$hotel}" style="display: inline-block; background-color: #181A18; color: #FFFDF9; padding: 12px 28px; border-radius: 999px; text-decoration: none; font-size: 12px; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase;">
                    Responder a {$nombre} &rarr;
                  </a>
                </td>
              </tr>
            </table>

          </td>
        </tr>

        <!-- Pie de página del correo -->
        <tr>
          <td style="background-color: #FAFAFA; border-top: 1px solid #ECE8E1; padding: 20px 36px; text-align: center;">
            <p style="margin: 0 0 4px 0; font-size: 11px; color: #9B9894; letter-spacing: 0.05em;">
              Enviado de forma segura mediante servidor SMTP: <strong>mail.uniformesjasana.com</strong> (SSL/TLS).
            </p>
            <p style="margin: 0; font-size: 11px; color: #BBB8B4;">
              Receptor configurado para pruebas: <strong>sistemas@uniformesjasana.com</strong>
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
</body>
</html>
HTML;

// Versión en texto plano para clientes de correo sin soporte HTML
$cuerpoTexto = "==================================================\n";
$cuerpoTexto .= "JASANA HOTELS & RESORTS - NUEVA COTIZACIÓN\n";
$cuerpoTexto .= "==================================================\n\n";
$cuerpoTexto .= "Fecha: $fechaHora\n";
$cuerpoTexto .= "Línea de Interés: $lineaTexto\n\n";
$cuerpoTexto .= "DATOS DEL CLIENTE:\n";
$cuerpoTexto .= "- Hotel / Empresa: $hotel\n";
$cuerpoTexto .= "- Contacto: $nombre\n";
$cuerpoTexto .= "- Ciudad / Ubicación: $ciudad\n";
$cuerpoTexto .= "- Correo: $correo\n";
$cuerpoTexto .= "- Teléfono: $telefono\n";
$cuerpoTexto .= "- Volumen estimado: $volumenTexto\n";
if (!empty($etiquetas)) {
    $cuerpoTexto .= "- Requerimientos clave: $etiquetas\n";
}
$cuerpoTexto .= "\nDETALLES DEL PROYECTO:\n";
$cuerpoTexto .= ($mensaje ?: "Sin comentarios adicionales") . "\n\n";
$cuerpoTexto .= "--------------------------------------------------\n";
$cuerpoTexto .= "Para responder a este cliente, responde directamente a este correo.\n";

// Envío a través del servidor SMTP seguro con Reply-To al cliente
$resultado = enviarCorreoSMTP(
    $destinatarios,
    $asunto,
    $cuerpoHtml,
    $cuerpoTexto,
    $correo,
    $nombre
);

if ($resultado['exito']) {
    echo json_encode([
        'exito' => true,
        'mensaje' => 'Tu solicitud ha sido recibida con éxito. Un asesor de JASANA se comunicará contigo a la brevedad.'
    ]);
} else {
    // Registro interno de error si falla
    error_log("[JASANA SMTP ERROR] " . ($resultado['error'] ?? 'Error desconocido'));
    
    http_response_code(500);
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Hubo un inconveniente al enviar la propuesta. Por favor intenta de nuevo o escríbenos directamente a info@uniformesjasana.com',
        'detalle' => $resultado['error'] ?? null
    ]);
}
exit;
