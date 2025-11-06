<?php
/**
 * TESTE PHPMAILER
 * Use este arquivo para testar se o PHPMailer está funcionando
 * Acesse: https://gerlenmascarenhas.com.br/test-phpmailer.php
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

echo "<h1>🧪 Teste PHPMailer</h1>";
echo "<hr>";

// ========================================
// CONFIGURAÇÕES - ALTERE AQUI
// ========================================
$smtp_host = 'mail.gerlenmascarenhas.com.br'; // ou smtp.gmail.com
$smtp_port = 465; // 465 ou 587
$smtp_secure = 'ssl'; // ssl ou tls
$smtp_username = 'noreply@gerlenmascarenhas.com.br'; // seu e-mail
$smtp_password = 'Alencar2!'; // sua senha

$email_destino = 'iokimdiego@hotmail.com'; // E-mail para receber o teste
// ========================================

echo "<strong>Configurações:</strong><br>";
echo "Host: $smtp_host<br>";
echo "Porta: $smtp_port<br>";
echo "Segurança: $smtp_secure<br>";
echo "Usuário: $smtp_username<br>";
echo "Senha: " . (empty($smtp_password) || $smtp_password == 'SUA_SENHA_AQUI' ? '❌ NÃO CONFIGURADA' : '✅ Configurada') . "<br>";
echo "<hr>";

if (empty($smtp_password) || $smtp_password == 'SUA_SENHA_AQUI') {
    echo "<p style='color: red;'><strong>❌ ERRO:</strong> Configure a senha SMTP no arquivo test-phpmailer.php (linha 18)</p>";
    exit;
}

try {
    echo "<p>📧 Iniciando teste de envio...</p>";
    
    $mail = new PHPMailer(true);
    
    // Configurações do servidor
    $mail->SMTPDebug = 2; // Debug detalhado
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = $smtp_secure;
    $mail->Port = $smtp_port;
    $mail->CharSet = 'UTF-8';
    
    echo "<p>✅ Configurações SMTP aplicadas</p>";
    
    // Remetente e destinatário
    $mail->setFrom($smtp_username, 'Teste PHPMailer');
    $mail->addAddress($email_destino);
    
    echo "<p>✅ Remetente e destinatário configurados</p>";
    
    // Conteúdo
    $mail->isHTML(true);
    $mail->Subject = '🧪 Teste PHPMailer - ' . date('d/m/Y H:i:s');
    $mail->Body = '
    <html>
    <body style="font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5;">
        <div style="max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px;">
            <h1 style="color: #3f7052;">✅ PHPMailer Funcionando!</h1>
            <p>Este é um e-mail de teste enviado em <strong>' . date('d/m/Y \à\s H:i:s') . '</strong></p>
            <p>Se você está recebendo este e-mail, significa que o PHPMailer está configurado corretamente!</p>
            <hr>
            <p style="font-size: 12px; color: #666;">
                Host: ' . $smtp_host . '<br>
                Porta: ' . $smtp_port . '<br>
                Segurança: ' . $smtp_secure . '
            </p>
        </div>
    </body>
    </html>
    ';
    
    echo "<p>✅ Conteúdo do e-mail preparado</p>";
    echo "<p>📤 Enviando e-mail...</p>";
    echo "<hr>";
    
    // Enviar
    $mail->send();
    
    echo "<hr>";
    echo "<h2 style='color: green;'>✅ E-MAIL ENVIADO COM SUCESSO!</h2>";
    echo "<p>Verifique a caixa de entrada (e spam) de: <strong>$email_destino</strong></p>";
    echo "<hr>";
    echo "<p><strong>Próximo passo:</strong> Edite o arquivo <code>send-email.php</code> e configure as mesmas credenciais.</p>";
    
} catch (Exception $e) {
    echo "<hr>";
    echo "<h2 style='color: red;'>❌ ERRO AO ENVIAR E-MAIL</h2>";
    echo "<p><strong>Mensagem de erro:</strong></p>";
    echo "<pre style='background: #ffe6e6; padding: 15px; border-radius: 5px; border-left: 4px solid red;'>";
    echo $e->getMessage();
    echo "</pre>";
    
    echo "<hr>";
    echo "<h3>💡 Soluções possíveis:</h3>";
    echo "<ul>";
    echo "<li><strong>Authentication failed:</strong> Verifique usuário e senha</li>";
    echo "<li><strong>Could not connect:</strong> Verifique o host e porta SMTP</li>";
    echo "<li><strong>SSL/TLS error:</strong> Troque 'ssl' por 'tls' ou a porta 465 por 587</li>";
    echo "<li><strong>Gmail:</strong> Use 'Senha de app' (não a senha normal)</li>";
    echo "</ul>";
    
    echo "<hr>";
    echo "<h3>📝 Informações do servidor:</h3>";
    echo "<ul>";
    echo "<li>PHP Version: " . phpversion() . "</li>";
    echo "<li>OpenSSL: " . (extension_loaded('openssl') ? '✅ Habilitado' : '❌ Desabilitado') . "</li>";
    echo "<li>PHPMailer: " . (class_exists('PHPMailer\PHPMailer\PHPMailer') ? '✅ Instalado' : '❌ Não encontrado') . "</li>";
    echo "</ul>";
}
?>
