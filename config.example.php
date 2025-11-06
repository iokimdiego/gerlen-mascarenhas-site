<?php
/**
 * GERLEN MASCARENHAS - Configurações de E-mail
 * 
 * INSTRUÇÕES:
 * 1. Copie este arquivo e renomeie para: config.php
 * 2. Preencha com suas credenciais reais
 * 3. NUNCA faça commit do arquivo config.php (está no .gitignore)
 */

// Configurações de E-mail
define('EMAIL_DESTINO', 'contato@gerlenmascarenhas.com.br');
define('EMAIL_COPIA', 'iokimdiego@hotmail.com');
define('NOME_REMETENTE', 'Site Dra. Gerlen Mascarenhas');
define('DOMINIO', 'gerlenmascarenhas.com.br');

// ============================================
// CONFIGURAÇÕES SMTP
// ============================================

// Opção 1: E-mail do Domínio (HostGator) - RECOMENDADO
define('SMTP_HOST', 'mail.gerlenmascarenhas.com.br'); // ou smtp.hostgator.com
define('SMTP_PORT', 465); // 465 para SSL ou 587 para TLS
define('SMTP_SECURE', 'ssl'); // 'ssl' ou 'tls'
define('SMTP_USERNAME', 'noreply@gerlenmascarenhas.com.br');
define('SMTP_PASSWORD', 'SUA_SENHA_AQUI'); // ← ALTERE COM SUA SENHA REAL

// Opção 2: Gmail (descomente e configure se preferir)
/*
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
define('SMTP_USERNAME', 'seu-email@gmail.com');
define('SMTP_PASSWORD', 'sua-senha-de-app-aqui'); // Senha de app do Google (16 dígitos)
*/

// Opção 3: Outlook/Hotmail (descomente e configure se preferir)
/*
define('SMTP_HOST', 'smtp-mail.outlook.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
define('SMTP_USERNAME', 'seu-email@outlook.com');
define('SMTP_PASSWORD', 'sua-senha-aqui');
*/

// ============================================
// MODO DEBUG
// ============================================
define('DEBUG_MODE', true); // true = desenvolvimento, false = produção

// ============================================
// CONFIGURAÇÕES ADICIONAIS
// ============================================
define('MAX_MESSAGE_LENGTH', 5000); // Tamanho máximo da mensagem
define('MIN_MESSAGE_LENGTH', 10); // Tamanho mínimo da mensagem
define('ALLOWED_ORIGINS', '*'); // '*' ou domínio específico
?>
