# 🔐 Configuração de Secrets no GitHub

## 📝 Instruções para Configurar GitHub Secrets

Para que o deploy automático funcione com segurança, você precisa configurar as credenciais como **Secrets** no GitHub.

---

## 🚀 Passo a Passo

### **1. Acessar Configurações do Repositório**

1. Acesse seu repositório: `https://github.com/iokimdiego/gerlen-mascarenhas-site`
2. Clique em **Settings** (Configurações)
3. No menu lateral, clique em **Secrets and variables** → **Actions**
4. Clique em **New repository secret**

---

### **2. Configurar Secrets de E-mail**

Adicione os seguintes secrets um por um:

#### **EMAIL_DESTINO**

```
Nome: EMAIL_DESTINO
Valor: contato@gerlenmascarenhas.com.br
```

#### **EMAIL_COPIA**

```
Nome: EMAIL_COPIA
Valor: iokimdiego@hotmail.com
```

---

### **3. Configurar Secrets SMTP**

#### **SMTP_HOST**

```
Nome: SMTP_HOST
Valor: smtp.titan.email
```

(Ou `smtp.gmail.com` se usar Gmail)

#### **SMTP_PORT**

```
Nome: SMTP_PORT
Valor: 587
```

(Ou `587` se usar TLS)

#### **SMTP_SECURE**

```
Nome: SMTP_SECURE
Valor: tls
```

(Ou `tls` se usar porta 587)

#### **SMTP_USERNAME**

```
Nome: SMTP_USERNAME
Valor: noreply@gerlenmascarenhas.com.br
```

(Ou seu e-mail do Gmail)

#### **SMTP_PASSWORD** ⚠️ **MAIS IMPORTANTE**

```
Nome: SMTP_PASSWORD
Valor: Alencar2!
```

**⚠️ IMPORTANTE:**

- No HostGator: Use a senha do e-mail criado no cPanel
- No Gmail: Use a "Senha de app" (16 dígitos)
- **NUNCA** compartilhe esta senha

---

### **4. Configurar Secrets FTP (se ainda não tiver)**

#### **FTP_SERVER**

```
Nome: FTP_SERVER
Valor: ftp.gerlenmascarenhas.com.br
```

#### **FTP_USERNAME**

```
Nome: FTP_USERNAME
Valor: [seu_usuario_ftp]
```

#### **FTP_PASSWORD**

```
Nome: FTP_PASSWORD
Valor: [sua_senha_ftp]
```

---

## ✅ Lista Completa de Secrets Necessários

Marque conforme for adicionando:

- [ ] `EMAIL_DESTINO` - E-mail que receberá as mensagens
- [ ] `EMAIL_COPIA` - E-mail de cópia
- [ ] `SMTP_HOST` - Servidor SMTP
- [ ] `SMTP_PORT` - Porta SMTP (465 ou 587)
- [ ] `SMTP_SECURE` - Tipo de segurança (ssl ou tls)
- [ ] `SMTP_USERNAME` - Usuário SMTP (e-mail)
- [ ] `SMTP_PASSWORD` - Senha SMTP ⚠️
- [ ] `FTP_SERVER` - Servidor FTP
- [ ] `FTP_USERNAME` - Usuário FTP
- [ ] `FTP_PASSWORD` - Senha FTP ⚠️

---

## 🔄 Como Funciona o Deploy

1. Você faz push para `main`
2. GitHub Actions executa o workflow
3. Cria o arquivo `config.php` usando os Secrets
4. Faz upload via FTP para o HostGator
5. O `config.php` é criado no servidor com suas credenciais

---

## 🧪 Testar o Deploy

Após configurar todos os secrets:

```bash
git add .
git commit -m "test: Testar deploy com secrets"
git push origin main
```

Acesse: `https://github.com/iokimdiego/gerlen-mascarenhas-site/actions`

Verifique se o workflow executou com sucesso (✅ verde).

---

## 🔒 Segurança dos Secrets

✅ **Os Secrets são seguros porque:**

- Nunca aparecem nos logs do GitHub Actions
- Não podem ser lidos por outras pessoas
- Só você (owner do repo) pode ver/editar
- São criptografados pelo GitHub

---

## 🆘 Troubleshooting

### **Erro: "Secret not found"**

- Verifique se o nome do secret está correto (maiúsculas/minúsculas importam)
- Certifique-se de salvou o secret

### **Erro: "Authentication failed"**

- Verifique se `SMTP_PASSWORD` está correto
- No Gmail, use "Senha de app" (não a senha normal)

### **Workflow não executa**

- Verifique se o arquivo `.github/workflows/deploy.yml` está correto
- Acesse `Actions` e veja se há erros

---

## 📸 Captura de Tela de Referência

**Localização dos Secrets:**

```
GitHub → Seu Repositório → Settings → Secrets and variables → Actions → New repository secret
```

---

## ✨ Exemplo de Configuração (Gmail)

Se preferir usar Gmail:

```
SMTP_HOST = smtp.gmail.com
SMTP_PORT = 587
SMTP_SECURE = tls
SMTP_USERNAME = seu-email@gmail.com
SMTP_PASSWORD = abcd efgh ijkl mnop  (senha de app de 16 dígitos)
```

---

## 📞 Próximo Passo

Após configurar todos os secrets:

1. ✅ Faça commit e push
2. ✅ Aguarde o deploy automático
3. ✅ Teste o formulário no site
4. ✅ Verifique se o e-mail chegou

---

**Guia criado por:** GitHub Copilot  
**Data:** 6 de novembro de 2025
