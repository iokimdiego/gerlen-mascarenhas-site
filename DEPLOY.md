# Configuração do Deploy Automático via GitHub Actions

## 🚀 Deploy Automático para Hostgator

Este repositório está configurado para fazer deploy automático na Hostgator sempre que houver um push na branch `main`.

## ⚙️ Configuração dos Secrets

Para que o deploy funcione, você precisa adicionar os seguintes **Secrets** no GitHub:

### Como adicionar Secrets:
1. Vá em **Settings** do repositório
2. Clique em **Secrets and variables** → **Actions**
3. Clique em **New repository secret**
4. Adicione os seguintes secrets:

### Secrets necessários:

#### `FTP_SERVER`
- **Descrição**: Endereço do servidor FTP da Hostgator
- **Exemplo**: `ftp.seudominio.com.br` ou `gatorXXXX.hostgator.com.br`
- **Como encontrar**: No cPanel da Hostgator → Seção "Arquivos" → "Contas FTP"

#### `FTP_USERNAME`
- **Descrição**: Usuário FTP
- **Exemplo**: `usuario@gerlenmascarenhas.com.br`
- **Como encontrar**: No cPanel → "Contas FTP" → Nome de usuário da conta FTP

#### `FTP_PASSWORD`
- **Descrição**: Senha do FTP
- **Exemplo**: Sua senha FTP
- **Como encontrar**: Use a senha que você criou ao configurar a conta FTP

---

## 📋 Informações da Hostgator

### Onde encontrar os dados de FTP:

1. **Acesse o cPanel da Hostgator**
   - URL: https://gatorXXXX.hostgator.com.br:2083
   - Ou através do painel de controle da Hostgator

2. **Contas FTP**
   - No cPanel, procure por "Contas FTP" na seção "Arquivos"
   - Aqui você encontra:
     - Servidor FTP
     - Nome de usuário
     - Diretório (geralmente `/public_html/`)

3. **Se não tiver conta FTP criada:**
   - Clique em "Adicionar conta FTP"
   - Crie um usuário e senha
   - Defina o diretório como `/public_html/`

---

## 🔧 Como funciona o Deploy

### Disparo automático:
- O deploy é executado automaticamente quando você faz `push` para a branch `main`

### Disparo manual:
- Vá em **Actions** no GitHub
- Selecione **Deploy to Hostgator**
- Clique em **Run workflow**

### O que é enviado:
- Todos os arquivos do site (HTML, CSS, JS, imagens)
- **Excluindo**: arquivos `.git`, `node_modules`, arquivos de documentação

### Diretório de destino:
- Os arquivos são enviados para `/public_html/` na Hostgator

---

## 🛠️ Configurações Avançadas

### Alterar diretório de destino:
Edite o arquivo `.github/workflows/deploy.yml`:
```yaml
server-dir: /public_html/  # Mude para seu diretório
```

### Usar SFTP (mais seguro):
Se sua Hostgator suporta SFTP, você pode usar:
```yaml
protocol: ftps  # ou sftp
port: 21  # Para FTP/FTPS, ou 22 para SFTP
```

### Adicionar mais exclusões:
Edite a seção `exclude:` no arquivo de workflow:
```yaml
exclude: |
  **/.git*
  **/node_modules/**
  **/seu-arquivo.txt
```

---

## 📝 Comandos Git para Deploy

```bash
# 1. Faça suas alterações no código

# 2. Adicione os arquivos
git add .

# 3. Commit das mudanças
git commit -m "Descrição das alterações"

# 4. Push para disparar o deploy automático
git push origin main
```

---

## ✅ Verificar Deploy

1. **No GitHub:**
   - Vá em **Actions**
   - Veja o status do workflow "Deploy to Hostgator"
   - ✅ Verde = Deploy bem-sucedido
   - ❌ Vermelho = Erro no deploy

2. **No site:**
   - Acesse https://gerlenmascarenhas.com.br
   - Verifique se as alterações foram aplicadas
   - Pode ser necessário limpar o cache (Ctrl+F5)

---

## 🚨 Solução de Problemas

### Deploy falhou?

1. **Verifique os Secrets:**
   - Confirme que os 3 secrets estão corretos
   - Sem espaços em branco no início/fim

2. **Erro de conexão FTP:**
   - Verifique se o servidor FTP está correto
   - Teste a conexão com FileZilla ou outro cliente FTP

3. **Erro de permissão:**
   - Verifique se o usuário FTP tem permissão de escrita em `/public_html/`

4. **Diretório incorreto:**
   - Confirme o diretório correto no cPanel → Contas FTP

### Testar manualmente:
Use um cliente FTP como [FileZilla](https://filezilla-project.org/):
- Servidor: valor de `FTP_SERVER`
- Usuário: valor de `FTP_USERNAME`
- Senha: valor de `FTP_PASSWORD`
- Porta: 21 (FTP padrão)

---

## 📞 Suporte

- **Hostgator**: https://suporte.hostgator.com.br
- **GitHub Actions**: https://docs.github.com/actions
- **FTP Deploy Action**: https://github.com/SamKirkland/FTP-Deploy-Action

---

## 🔒 Segurança

- ✅ **Nunca** commite senhas ou credenciais no código
- ✅ Use sempre GitHub Secrets para informações sensíveis
- ✅ Mantenha seus secrets seguros
- ✅ Revogue acessos FTP desnecessários no cPanel

---

Desenvolvido por [Iokim Diego](https://iokimdiego.dev.br)
