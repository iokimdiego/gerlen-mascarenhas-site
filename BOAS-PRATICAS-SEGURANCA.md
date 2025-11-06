# 🔒 Boas Práticas de Segurança - Checklist

## ✅ **ANTES DE CADA COMMIT**

Execute sempre este checklist:

### 1. Verificar arquivos a serem commitados

```bash
git status
```

**❌ Se aparecer algum desses, NÃO commite:**

- `config.php`
- `email-logs.txt`
- `.env` ou `.env.local`
- Arquivos `.backup` ou `.bak`

### 2. Verificar conteúdo antes de adicionar

```bash
git diff
```

**❌ Procure por:**

- Senhas hardcoded
- API keys
- Tokens de autenticação
- Dados de cartão de crédito
- Dados pessoais sensíveis

### 3. Adicionar apenas arquivos seguros

```bash
# ✅ CORRETO: Adicionar arquivo específico
git add arquivo-seguro.js

# ❌ ERRADO: Adicionar tudo sem verificar
git add .  # Cuidado! Verifica antes com git status
```

---

## 🚨 **NUNCA Commite Estes Arquivos**

```
❌ config.php
❌ .env
❌ .env.local
❌ .env.production
❌ email-logs.txt
❌ *.log
❌ *.backup
❌ *.bak
❌ database.sql
❌ dump.sql
```

---

## ✅ **SEMPRE Use Placeholders em Exemplos**

### ❌ ERRADO:

```php
define('SMTP_PASSWORD', 'Alencar2!');  // Senha real exposta!
```

### ✅ CORRETO:

```php
define('SMTP_PASSWORD', 'SUA_SENHA_AQUI');  // Placeholder genérico
```

---

## 🔐 **Workflow Seguro**

### **Desenvolvimento Local:**

1. Copie `config.example.php` → `config.php`
2. Preencha suas credenciais reais em `config.php`
3. Trabalhe normalmente
4. **NUNCA** commite `config.php`

### **Deploy em Produção:**

1. Use GitHub Secrets para credenciais
2. GitHub Actions gera `config.php` automaticamente
3. Servidor recebe arquivo com credenciais corretas
4. `config.php` nunca passa pelo Git

---

## 📝 **Verificação de Segurança Rápida**

### Comando 1: Ver o que será commitado

```bash
git diff --cached
```

### Comando 2: Verificar se config.php está ignorado

```bash
git check-ignore config.php
# Deve retornar: config.php
```

### Comando 3: Ver histórico de um arquivo sensível

```bash
git log --all -- config.php
# Deve retornar VAZIO (nunca foi commitado)
```

### Comando 4: Buscar senhas no código

```bash
# PowerShell
Select-String -Pattern "password.*=.*['\"](?!SUA_SENHA|senha|password)" -Path *.php,*.js

# Linux/Mac
grep -r "password.*=.*['\"]" --include="*.php" --include="*.js" .
```

---

## 🛡️ **Proteção em Camadas**

### **Camada 1: .gitignore**

```ignore
# Adicione SEMPRE
config.php
.env
*.log
*.backup
email-logs.txt
```

### **Camada 2: .htaccess**

```apache
# Bloqueia acesso web
<Files "config.php">
    Deny from all
</Files>
```

### **Camada 3: GitHub Secrets**

```yaml
# No workflow, use:
${{ secrets.SMTP_PASSWORD }}
# NUNCA coloque a senha direto no arquivo!
```

---

## 🚨 **Se Você Acidentalmente Expor Credenciais**

### **Passo 1: TROCAR SENHAS IMEDIATAMENTE**

- HostGator: cPanel → Contas de E-mail → Alterar Senha
- Gmail: Gerar nova "Senha de app"
- Banco: Trocar senha do usuário

### **Passo 2: Atualizar GitHub Secrets**

```
GitHub → Settings → Secrets → Actions
Atualizar: SMTP_PASSWORD
```

### **Passo 3: Remover do Git**

```bash
# Remover do último commit
git reset HEAD~1
git add arquivo-corrigido.php
git commit -m "Fix: Remove exposed credentials"
git push --force

# Remover do histórico completo (CUIDADO!)
# Use apenas se realmente necessário
git filter-branch --force --index-filter \
  "git rm --cached --ignore-unmatch config.php" \
  --prune-empty -- --all
git push --force --all
```

### **Passo 4: Fazer novo deploy**

```bash
git push origin main
# GitHub Actions rodará com novas credenciais
```

---

## 📋 **Checklist Pré-Deploy**

- [ ] Arquivo `config.php` está no `.gitignore`?
- [ ] Testei com `git check-ignore config.php`?
- [ ] Revisei `git diff` antes de commitar?
- [ ] Todos os GitHub Secrets estão configurados?
- [ ] Senhas em arquivos .md são apenas placeholders?
- [ ] `.htaccess` bloqueia acesso a arquivos sensíveis?
- [ ] `DEBUG_MODE` está `false` em produção?
- [ ] Arquivos de teste foram removidos do servidor?

---

## 🎯 **Comandos Úteis**

### Ver arquivos ignorados

```bash
git ls-files --others --ignored --exclude-standard
```

### Ver todos os arquivos trackeados

```bash
git ls-files
```

### Verificar se arquivo está no repositório

```bash
git ls-files | grep config.php
# Deve retornar VAZIO
```

### Forçar Git a ignorar arquivo já trackeado

```bash
git rm --cached config.php
git commit -m "Remove config.php from tracking"
```

---

## ✅ **Resumo: O Que Fazer e Não Fazer**

### ✅ SEMPRE:

- Use `git status` antes de commitar
- Revise `git diff` antes de commitar
- Use placeholders em arquivos de exemplo
- Mantenha `.gitignore` atualizado
- Use GitHub Secrets para credenciais
- Revise Pull Requests buscando senhas

### ❌ NUNCA:

- Commite arquivos com senhas reais
- Use `git add .` sem verificar antes
- Exponha API keys em código público
- Compartilhe config.php por e-mail/chat
- Faça backup de config.php no Git
- Deixe DEBUG_MODE = true em produção

---

## 📚 **Recursos Adicionais**

### **Ferramentas de Verificação:**

- [GitGuardian](https://www.gitguardian.com/) - Detecta secrets no código
- [TruffleHog](https://github.com/trufflesecurity/trufflehog) - Scanner de secrets
- [git-secrets](https://github.com/awslabs/git-secrets) - Previne commits com secrets

### **Gerenciadores de Senhas:**

- LastPass
- 1Password
- Bitwarden
- KeePass

### **Documentação:**

- [GitHub Secrets Documentation](https://docs.github.com/en/actions/security-guides/encrypted-secrets)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)

---

## 🎓 **Treinamento da Equipe**

Se você trabalha em equipe:

1. **Compartilhe este documento** com todos os desenvolvedores
2. **Faça code review** antes de aceitar Pull Requests
3. **Configure branch protection** no GitHub
4. **Use pre-commit hooks** para bloquear commits com secrets
5. **Documente o processo** de configuração segura

---

## 📞 **Em Caso de Dúvida**

**ANTES de commitar algo suspeito, pergunte:**

- Este arquivo contém senhas ou tokens?
- Este arquivo deveria estar no .gitignore?
- Alguém mal-intencionado poderia usar esta informação?
- Eu me sentiria confortável se isso fosse público?

**Se a resposta for SIM para qualquer uma, NÃO commite!**

---

✅ **SEGURANÇA É PRIORIDADE - SEMPRE VERIFIQUE ANTES DE COMMITAR!**

---

**Atualizado em:** 6 de novembro de 2025  
**Versão:** 1.0  
**Autor:** GitHub Copilot
