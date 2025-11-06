<?php
/**
 * Teste Rápido de Envio de E-mail - HostGator
 * Acesse: https://gerlenmascarenhas.com.br/test-email.php
 */

// Configuração
$emailDestino = 'iokimdiego@hotmail.com'; // Altere para seu e-mail
$nomeRemetente = 'Teste HostGator';

// Informações do sistema
echo "<h1>🧪 Teste de E-mail - HostGator</h1>";
echo "<hr>";
echo "<h2>📊 Informações do Servidor:</h2>";
echo "<ul>";
echo "<li><strong>PHP Versão:</strong> " . phpversion() . "</li>";
echo "<li><strong>Servidor:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</li>";
echo "<li><strong>Mail Function:</strong> " . (function_exists('mail') ? '✅ Disponível' : '❌ Não disponível') . "</li>";
echo "<li><strong>Hostname:</strong> " . gethostname() . "</li>";
echo "</ul>";
echo "<hr>";

// Teste de envio
echo "<h2>📧 Enviando E-mail de Teste...</h2>";

$assunto = 'Teste de Envio - Site Gerlen Mascarenhas';
$mensagem = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; background: #f5efe6; border-radius: 10px; }
        .success { color: #3f7052; font-weight: bold; }
    </style>
</head>
<body>
    <div class='container'>
        <h1 class='success'>✅ Teste Bem-Sucedido!</h1>
        <p>Se você está lendo este e-mail, significa que o sistema de envio do HostGator está funcionando corretamente.</p>
        <p><strong>Data/Hora:</strong> " . date('d/m/Y H:i:s') . "</p>
        <p><strong>Servidor:</strong> " . $_SERVER['SERVER_NAME'] . "</p>
        <p><strong>IP:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>
    </div>
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
$headers .= "From: {$nomeRemetente} <noreply@gerlenmascarenhas.com.br>" . "\r\n";

if (mail($emailDestino, $assunto, $mensagem, $headers)) {
    echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; color: #155724;'>";
    echo "<h3>✅ E-mail Enviado com Sucesso!</h3>";
    echo "<p>Verifique a caixa de entrada (e spam) de: <strong>{$emailDestino}</strong></p>";
    echo "</div>";
} else {
    echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; color: #721c24;'>";
    echo "<h3>❌ Erro ao Enviar E-mail</h3>";
    echo "<p>Entre em contato com o suporte do HostGator para verificar as configurações de e-mail.</p>";
    echo "</div>";
}

echo "<hr>";
echo "<h2>🔧 Configuração do send-email.php:</h2>";
echo "<p>Certifique-se de que o arquivo <code>send-email.php</code> tem as seguintes configurações:</p>";
echo "<pre style='background: #f5f5f5; padding: 15px; border-radius: 5px; overflow-x: auto;'>";
echo "define('EMAIL_DESTINO', 'contato@gerlenmascarenhas.com.br');\n";
echo "define('EMAIL_COPIA', 'iokimdiego@hotmail.com');\n";
echo "define('NOME_REMETENTE', 'Site Dra. Gerlen Mascarenhas');";
echo "</pre>";

echo "<hr>";
echo "<p><small>🗑️ Após confirmar que o e-mail funciona, <strong>delete este arquivo</strong> por segurança.</small></p>";
?>
