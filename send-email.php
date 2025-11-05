<?php
/**
 * GERLEN MASCARENHAS - Sistema de Envio de E-mails
 * Backend PHP para formulário de contato
 */

// Configurações de segurança
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Configurações de e-mail
define('EMAIL_DESTINO', 'contato@gerlenmascarenhas.com.br');
define('EMAIL_COPIA', 'iokimdiego@hotmail.com'); // E-mail adicional (opcional)
define('NOME_REMETENTE', 'Site Dra. Gerlen Mascarenhas');

// Função para sanitizar dados
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Função para validar e-mail
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Função para validar telefone brasileiro
function isValidPhone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    return strlen($phone) >= 10 && strlen($phone) <= 11;
}

// Verificar se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Método não permitido. Use POST.'
    ]);
    exit;
}

// Obter dados do formulário
$name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
$phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
$message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';

// Array de erros
$errors = [];

// Validações
if (empty($name) || strlen($name) < 3) {
    $errors[] = 'Nome completo é obrigatório (mínimo 3 caracteres).';
}

if (empty($email) || !isValidEmail($email)) {
    $errors[] = 'E-mail válido é obrigatório.';
}

if (empty($phone) || !isValidPhone($phone)) {
    $errors[] = 'Telefone válido é obrigatório.';
}

if (empty($message) || strlen($message) < 10) {
    $errors[] = 'Mensagem é obrigatória (mínimo 10 caracteres).';
}

// Se houver erros, retornar
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Erro na validação dos dados.',
        'errors' => $errors
    ]);
    exit;
}

// Preparar o e-mail
$assunto = '📧 Nova Mensagem do Site - ' . $name;

// Corpo do e-mail em HTML
$corpo = "
<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5efe6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #3f7052, #2e5a40);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px 20px;
        }
        .field {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f5efe6;
            border-left: 4px solid #3f7052;
            border-radius: 6px;
        }
        .field-label {
            font-weight: 600;
            color: #3f7052;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .field-value {
            font-size: 16px;
            color: #333333;
            line-height: 1.6;
        }
        .message-box {
            background-color: #ffffff;
            border: 2px solid #3f7052;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .footer {
            background-color: #f5efe6;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }
        .footer a {
            color: #3f7052;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>📧 Nova Mensagem Recebida</h1>
            <p style='margin: 10px 0 0 0; font-size: 14px;'>Site Dra. Gerlen Mascarenhas</p>
        </div>
        <div class='content'>
            <div class='field'>
                <div class='field-label'>👤 Nome Completo</div>
                <div class='field-value'>{$name}</div>
            </div>
            
            <div class='field'>
                <div class='field-label'>📧 E-mail</div>
                <div class='field-value'><a href='mailto:{$email}' style='color: #3f7052; text-decoration: none;'>{$email}</a></div>
            </div>
            
            <div class='field'>
                <div class='field-label'>📱 Telefone/WhatsApp</div>
                <div class='field-value'><a href='https://wa.me/55{$phone}' style='color: #3f7052; text-decoration: none;' target='_blank'>{$phone}</a></div>
            </div>
            
            <div class='field'>
                <div class='field-label'>💬 Mensagem</div>
                <div class='message-box'>
                    <p style='margin: 0; white-space: pre-wrap;'>{$message}</p>
                </div>
            </div>
            
            <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0;'>
                <p style='margin: 0; font-size: 14px; color: #666666;'>
                    <strong>📅 Data/Hora:</strong> " . date('d/m/Y \à\s H:i:s') . "<br>
                    <strong>🌐 IP:</strong> " . $_SERVER['REMOTE_ADDR'] . "
                </p>
            </div>
        </div>
        <div class='footer'>
            <p style='margin: 0 0 10px 0;'><strong>Dra. Gerlen Mascarenhas - Fisioterapia</strong></p>
            <p style='margin: 0;'>
                <a href='https://gerlenmascarenhas.com.br'>gerlenmascarenhas.com.br</a> | 
                <a href='tel:+5592992555753'>(92) 99255-5753</a>
            </p>
        </div>
    </div>
</body>
</html>
";

// Headers do e-mail
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
$headers .= "From: " . NOME_REMETENTE . " <noreply@gerlenmascarenhas.com.br>" . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Enviar e-mail principal
$enviado = mail(EMAIL_DESTINO, $assunto, $corpo, $headers);

// Enviar cópia (opcional)
if (defined('EMAIL_COPIA') && !empty(EMAIL_COPIA)) {
    mail(EMAIL_COPIA, $assunto, $corpo, $headers);
}

// E-mail de confirmação para o usuário
if ($enviado) {
    $assuntoConfirmacao = '✅ Mensagem Recebida - Dra. Gerlen Mascarenhas';
    $corpoConfirmacao = "
    <!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f5efe6; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; }
            .header { background: linear-gradient(135deg, #3f7052, #2e5a40); color: #ffffff; padding: 30px 20px; text-align: center; }
            .content { padding: 30px 20px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1 style='margin: 0;'>✅ Mensagem Recebida!</h1>
            </div>
            <div class='content'>
                <p>Olá <strong>{$name}</strong>,</p>
                <p>Recebemos sua mensagem e entraremos em contato em breve.</p>
                <p style='background: #f5efe6; padding: 15px; border-radius: 8px;'>
                    <strong>Sua mensagem:</strong><br>
                    {$message}
                </p>
                <p>Atenciosamente,<br><strong>Dra. Gerlen Mascarenhas</strong></p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    $headersConfirmacao = "MIME-Version: 1.0" . "\r\n";
    $headersConfirmacao .= "Content-type: text/html; charset=utf-8" . "\r\n";
    $headersConfirmacao .= "From: " . NOME_REMETENTE . " <noreply@gerlenmascarenhas.com.br>" . "\r\n";
    
    mail($email, $assuntoConfirmacao, $corpoConfirmacao, $headersConfirmacao);
}

// Resposta JSON
if ($enviado) {
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Mensagem enviada com sucesso! Entraremos em contato em breve.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao enviar mensagem. Tente novamente mais tarde.'
    ]);
}
?>