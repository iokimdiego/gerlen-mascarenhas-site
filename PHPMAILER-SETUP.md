# 📧 Guia de Configuração PHPMailer

## ✅ Implementação Concluída

O sistema de envio de e-mails foi atualizado para usar **PHPMailer** em vez da função `mail()` nativa do PHP.

---

## 🚀 Como Configurar (Passo a Passo)

### **Passo 1: Escolha o Provedor de E-mail**

Você tem 3 opções:

#### **Opção 1: E-mail do Próprio Domínio (HostGator)** ⭐ Recomendado

- ✅ Mais profissional
- ✅ Evita cair em spam
- ⚠️ Requer criar e-mail no cPanel

#### **Opção 2: Gmail**

- ✅ Mais confiável
- ✅ Fácil de configurar
- ⚠️ Requer "Senha de app"

#### **Opção 3: Outlook/Hotmail**

- ✅ Funciona bem
- ⚠️ Pode ter limites de envio

---

### **Passo 2: Configurar no cPanel (Opção 1)**

1. Acesse o **cPanel do HostGator**
2. Procure por **"Contas de E-mail"**
3. Clique em **"Criar"**
4. Preencha:
   - **E-mail:** `noreply@gerlenmascarenhas.com.br`
   - **Senha:** Crie uma senha forte (anote!)
5. Clique em **"Criar"**

---

### **Passo 3: Editar send-email.php**

Abra o arquivo `send-email.php` e localize as linhas 26-32:

```php
// Configurações SMTP (Configure com suas credenciais)
define('SMTP_HOST', 'mail.gerlenmascarenhas.com.br');
define('SMTP_PORT', 465);
define('SMTP_SECURE', 'ssl');
define('SMTP_USERNAME', 'noreply@gerlenmascarenhas.com.br');
define('SMTP_PASSWORD', 'SUA_SENHA_AQUI'); // ← ALTERE AQUI
```

**Substitua `SUA_SENHA_AQUI`** pela senha que você criou no Passo 2.

#### **Se for usar Gmail:**

```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
define('SMTP_USERNAME', 'seu-email@gmail.com');
define('SMTP_PASSWORD', 'senha-de-app-do-google'); // Senha de 16 dígitos
```

**Como gerar Senha de App no Gmail:**

1. Acesse: https://myaccount.google.com/security
2. Ative **"Verificação em duas etapas"**
3. Procure **"Senhas de app"**
4. Selecione **"Correio"** e **"Outro"**
5. Copie a senha de 16 dígitos

---

### **Passo 4: Testar o Envio**

1. Faça upload dos arquivos:

   - `send-email.php` (atualizado)
   - `test-phpmailer.php`

2. **Edite `test-phpmailer.php`** (linhas 13-18):

```php
$smtp_host = 'mail.gerlenmascarenhas.com.br';
$smtp_port = 465;
$smtp_secure = 'ssl';
$smtp_username = 'noreply@gerlenmascarenhas.com.br';
$smtp_password = 'SENHA_QUE_VOCE_CRIOU'; // ← ALTERE AQUI
$email_destino = 'iokimdiego@hotmail.com'; // ← SEU E-MAIL DE TESTE
```

3. Acesse no navegador:

```
https://gerlenmascarenhas.com.br/test-phpmailer.php
```

4. Se aparecer **"✅ E-MAIL ENVIADO COM SUCESSO!"**, está funcionando!

5. Verifique sua caixa de entrada (e spam)

---

### **Passo 5: Desativar Debug (Produção)**

Após confirmar que está funcionando, edite `send-email.php`:

```php
define('DEBUG_MODE', false); // Altere de true para false
```

Isso desativa os logs detalhados e melhora a performance.

---

## 🔧 Troubleshooting

### **❌ Erro: "Authentication failed"**

- Verifique se o usuário e senha estão corretos
- No Gmail, certifique-se de usar "Senha de app" (não a senha normal)
- Verifique se a conta de e-mail existe no cPanel

### **❌ Erro: "Could not connect to SMTP host"**

- Tente trocar a porta: `465` ↔ `587`
- Tente trocar a segurança: `ssl` ↔ `tls`
- Verifique se o host está correto

### **❌ Erro: "SMTP connect() failed"**

- Verifique se o servidor permite conexões SMTP
- Entre em contato com o suporte do HostGator

### **❌ E-mail cai no spam**

- Configure SPF no DNS: `v=spf1 include:hostgator.com ~all`
- Ative DKIM no cPanel
- Use e-mail do próprio domínio (não Gmail)

---

## 📊 Configurações por Provedor

| Provedor      | Host                            | Porta | Segurança | Observações             |
| ------------- | ------------------------------- | ----- | --------- | ----------------------- |
| **HostGator** | `mail.gerlenmascarenhas.com.br` | 465   | ssl       | E-mail criado no cPanel |
| **Gmail**     | `smtp.gmail.com`                | 587   | tls       | Usar "Senha de app"     |
| **Outlook**   | `smtp-mail.outlook.com`         | 587   | tls       | Senha normal            |

---

## 📁 Arquivos Criados

- ✅ `send-email.php` - Backend de envio (ATUALIZADO)
- ✅ `test-phpmailer.php` - Arquivo de teste
- ✅ `smtp-config-example.txt` - Exemplos de configuração
- ✅ `PHPMAILER-SETUP.md` - Este guia

---

## 🎯 Próximos Passos

1. ✅ Configure as credenciais SMTP no `send-email.php`
2. ✅ Configure e teste o `test-phpmailer.php`
3. ✅ Teste o formulário do site
4. ✅ Desative o debug mode
5. ✅ **Depois de testar, DELETE o arquivo `test-phpmailer.php`** (segurança)

---

## 📞 Suporte

Se tiver problemas:

1. Verifique o arquivo `email-logs.txt` (criado automaticamente)
2. Leia as mensagens de erro com atenção
3. Consulte o `smtp-config-example.txt`
4. Entre em contato com o suporte do HostGator se necessário

---

## 🔒 Segurança

⚠️ **IMPORTANTE:**

- Nunca commite o `send-email.php` com a senha no GitHub
- Delete o `test-phpmailer.php` após configurar
- Mantenha `DEBUG_MODE = false` em produção
- Use senhas fortes para as contas de e-mail

---

## ✨ Recursos Implementados

✅ Envio via PHPMailer com SMTP  
✅ E-mail HTML profissional  
✅ E-mail de confirmação para o usuário  
✅ Cópia para e-mail adicional  
✅ Sistema de logs detalhado  
✅ Validação de dados  
✅ Sanitização contra injeção  
✅ Tratamento de erros robusto  
✅ Modo debug para troubleshooting

---

**Configuração criada por:** GitHub Copilot  
**Data:** 6 de novembro de 2025  
**Versão:** 3.0 com PHPMailer
