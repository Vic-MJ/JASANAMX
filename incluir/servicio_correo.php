<?php
define('JASANA_SMTP_HOST', 'ssl://mail.jasana.mx');
define('JASANA_SMTP_PORT', 465);
define('JASANA_SMTP_USER', 'info@jasana.mx');
define('JASANA_SMTP_PASS', '%bP@!7mFQ8qc7eHm');
define('JASANA_MAIL_FROM_EMAIL', 'info@uniformesjasana.com');
define('JASANA_MAIL_FROM_NAME', 'Uniformes JASANA - Cotizaciones Web');
define('JASANA_MAIL_DESTINATARIO_SIGNATURE', 'ventas@uniformesjasana.com');
define('JASANA_MAIL_DESTINATARIO_ESSENTIALS', 'ventas.gdl@uniformesjasana.com');
define('JASANA_MAIL_DESTINATARIO_BATH_BED', 'ventas.gdl@uniformesjasana.com');
define('JASANA_MAIL_DESTINATARIO_CYCLES', 'info.cycles@jasana.mx');
define('JASANA_MAIL_DESTINATARIO_GENERAL', 'ventas@uniformesjasana.com');

function enviarCorreoSMTP($destinatarios, $asunto, $cuerpoHtml, $cuerpoTexto = '', $replyToEmail = null, $replyToNombre = null) {
    if (!is_array($destinatarios)) {
        $destinatarios = [$destinatarios];
    }

    $context = stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    $socket = @stream_socket_client(
        JASANA_SMTP_HOST . ':' . JASANA_SMTP_PORT,
        $errno,
        $errstr,
        15,
        STREAM_CLIENT_CONNECT,
        $context
    );

    if (!$socket) {
        return [
            'exito' => false,
            'mensaje' => 'No fue posible conectar con el servidor de correo saliente.',
            'error' => "Error de conexión [$errno]: $errstr"
        ];
    }

    stream_set_timeout($socket, 15);

    $leerRespuesta = function () use ($socket) {
        $respuesta = '';
        while (!feof($socket)) {
            $linea = fgets($socket, 515);
            if ($linea === false) break;
            $respuesta .= $linea;
            if (strlen($linea) >= 4 && substr($linea, 3, 1) === ' ') {
                break;
            }
        }
        return $respuesta;
    };

    $enviarComando = function ($cmd, $codigoEsperado = null) use ($socket, $leerRespuesta) {
        fputs($socket, $cmd . "\r\n");
        $res = $leerRespuesta();
        $codigo = substr($res, 0, 3);
        if ($codigoEsperado !== null && $codigo !== (string)$codigoEsperado) {
            return ['ok' => false, 'codigo' => $codigo, 'respuesta' => $res];
        }
        return ['ok' => true, 'codigo' => $codigo, 'respuesta' => $res];
    };

    $bienvenida = $leerRespuesta();
    if (substr($bienvenida, 0, 3) !== '220') {
        fclose($socket);
        return ['exito' => false, 'error' => "Bienvenida inesperada: $bienvenida"];
    }

    $hostLocal = !empty($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : gethostname();
    if (empty($hostLocal) || $hostLocal === 'localhost') $hostLocal = 'jasana.mx';
    $r = $enviarComando('EHLO ' . $hostLocal, '250');
    if (!$r['ok']) {
        fclose($socket);
        return ['exito' => false, 'error' => "Fallo EHLO: " . $r['respuesta']];
    }

    $r = $enviarComando('AUTH LOGIN', '334');
    if (!$r['ok']) {
        fclose($socket);
        return ['exito' => false, 'error' => "Fallo al iniciar autenticación: " . $r['respuesta']];
    }

    $r = $enviarComando(base64_encode(JASANA_SMTP_USER), '334');
    if (!$r['ok']) {
        fclose($socket);
        return ['exito' => false, 'error' => "Usuario SMTP rechazado: " . $r['respuesta']];
    }

    $r = $enviarComando(base64_encode(JASANA_SMTP_PASS), '235');
    if (!$r['ok']) {
        fclose($socket);
        return ['exito' => false, 'error' => "Contraseña SMTP rechazada: " . $r['respuesta']];
    }

    $envelopeSender = JASANA_SMTP_USER;
    $r = $enviarComando('MAIL FROM:<' . $envelopeSender . '>', '250');
    if (!$r['ok']) {
        $r = $enviarComando('MAIL FROM:<' . JASANA_MAIL_FROM_EMAIL . '>', '250');
        if (!$r['ok']) {
            fclose($socket);
            return ['exito' => false, 'error' => "Fallo MAIL FROM: " . $r['respuesta']];
        }
    }

    $aceptados = 0;
    foreach ($destinatarios as $dest) {
        $dest = trim($dest);
        if (empty($dest)) continue;
        $r = $enviarComando('RCPT TO:<' . $dest . '>', '250');
        if ($r['ok']) {
            $aceptados++;
        }
    }

    if ($aceptados === 0) {
        $fallbackEmail = defined('JASANA_MAIL_DESTINATARIO_GENERAL') ? JASANA_MAIL_DESTINATARIO_GENERAL : 'ventas@uniformesjasana.com';
        $r = $enviarComando('RCPT TO:<' . $fallbackEmail . '>', '250');
        if ($r['ok']) {
            $aceptados++;
        } else {
            fclose($socket);
            return ['exito' => false, 'error' => "Ningún destinatario fue aceptado por el servidor."];
        }
    }

    $r = $enviarComando('DATA', '354');
    if (!$r['ok']) {
        fclose($socket);
        return ['exito' => false, 'error' => "Fallo comando DATA: " . $r['respuesta']];
    }

    $boundary = '=_jasana_' . md5(uniqid((string)time(), true));
    $asuntoCodificado = '=?UTF-8?B?' . base64_encode($asunto) . '?=';
    $remitenteCodificado = '=?UTF-8?B?' . base64_encode(JASANA_MAIL_FROM_NAME) . '?= <' . JASANA_MAIL_FROM_EMAIL . '>';

    $headers = [];
    $headers[] = 'Date: ' . date('r');
    $headers[] = 'From: ' . $remitenteCodificado;
    $headers[] = 'To: ' . implode(', ', array_map(function($d) { return '<' . trim($d) . '>'; }, $destinatarios));
    if ($replyToEmail) {
        if ($replyToNombre) {
            $headers[] = 'Reply-To: =?UTF-8?B?' . base64_encode($replyToNombre) . '?= <' . trim($replyToEmail) . '>';
        } else {
            $headers[] = 'Reply-To: <' . trim($replyToEmail) . '>';
        }
    }
    $headers[] = 'Subject: ' . $asuntoCodificado;
    $headers[] = 'Message-ID: <' . time() . '.' . md5(uniqid()) . '@' . 'jasana.mx>';
    $headers[] = 'X-Mailer: JASANA Web Engine';
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: multipart/alternative; boundary="' . $boundary . '"';

    $cuerpoMensaje = [];
    $cuerpoMensaje[] = '--' . $boundary;
    $cuerpoMensaje[] = 'Content-Type: text/plain; charset=UTF-8';
    $cuerpoMensaje[] = 'Content-Transfer-Encoding: 8bit';
    $cuerpoMensaje[] = '';
    $cuerpoMensaje[] = !empty($cuerpoTexto) ? $cuerpoTexto : strip_tags($cuerpoHtml);
    $cuerpoMensaje[] = '';
    $cuerpoMensaje[] = '--' . $boundary;
    $cuerpoMensaje[] = 'Content-Type: text/html; charset=UTF-8';
    $cuerpoMensaje[] = 'Content-Transfer-Encoding: 8bit';
    $cuerpoMensaje[] = '';
    $cuerpoMensaje[] = $cuerpoHtml;
    $cuerpoMensaje[] = '';
    $cuerpoMensaje[] = '--' . $boundary . '--';

    $payload = implode("\r\n", $headers) . "\r\n\r\n" . implode("\r\n", $cuerpoMensaje);
    
    $payload = preg_replace('/^\./m', '..', $payload);
    $payloadFinal = $payload . "\r\n.";

    $r = $enviarComando($payloadFinal, '250');
    if (!$r['ok']) {
        fclose($socket);
        return ['exito' => false, 'error' => "Error al transferir contenido DATA: " . $r['respuesta']];
    }

    $enviarComando('QUIT');
    fclose($socket);

    return [
        'exito' => true,
        'mensaje' => 'Correo enviado exitosamente vía SMTP seguro.'
    ];
}
