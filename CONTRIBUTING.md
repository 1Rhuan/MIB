# Guia de Contribuição

Olá! Antes de começar a contribuir com este projeto, por favor leia e siga este guia. Garantimos que ele irá ajudá-lo a colaborar de forma mais eficiente e consistente.

Muito obrigado pela sua contribuição!

---

## Índice

1. [Como Posso Contribuir?](#como-posso-contribuir)
2. [Configurando o Ambiente](#configurando-o-ambiente)
3. [Padrões de Código e Commit](#padrões-de-código-e-commit)
4. [Padrões de Branches](#padrões-de-branches)
5. [Testes](#testes)
6. [Problemas e Sugestões](#problemas-e-sugestões)

---

## Como Posso Contribuir?

Existem várias formas de contribuir com o projeto. Aqui estão algumas ideias:
- 📦 **Relatar Bugs:** Encontre um problema? Reporte-o!
- 💡 **Solicitar Funcionalidades:** Proponha ideias para melhorar o projeto.
- 🔧 **Corrigir Bugs:** Identifique e corrija problemas no código.
- 🆕 **Adicionar Funcionalidades:** Proponha e implemente novas funcionalidades.
- 📖 **Melhorar a Documentação:** Ajude a manter este guia, o README ou qualquer outro documento atualizado.

---

## Configurando o Ambiente

Se você deseja configurar o projeto na sua máquina, siga estes passos:

### 1. Clone o Repositório
Primeiro, clone este repositório localmente:
```bash
git clone https://github.com/1rhuan/MIB.git
```

### 2. Instale as Dependências
Certifique-se de que você tenha o **Composer** instalado na máquina e então rode este comando:
```bash
composer install
```

### 3. Configure o Arquivo `.env`
Copie o exemplo `.env` para começar:
```bash
cp .env.example .env
```
Em seguida, edite o `.env` com as credenciais específicas do seu ambiente, como banco de dados, chave do serviço Mercado Pago, etc.

### 4. Gere a Chave da Aplicação
Execute o seguinte comando:
```bash
php artisan key:generate
```

### 5. Configure o Banco de Dados
Certifique-se de que seu banco de dados está funcionando e rode as migrações:
```bash
php artisan migrate
```

### 6. Execute o Servidor
Para iniciar o servidor local de desenvolvimento:
```bash
php artisan serve
```

Agora, seu ambiente está pronto e você pode começar a desenvolver no projeto!

---

## Padrões de Código e Commit

Manter padrões é fundamental para manter o projeto organizado. Por isso, siga os padrões abaixo ao contribuir:

### 1. **Padrões de Estilo**
- O código segue os padrões PSR-12.
- Use a ferramenta `php-cs-fixer` para garantir a formatação correta. Instale e rode:
```bash
composer global require friendsofphp/php-cs-fixer
php-cs-fixer fix --allow-risky=yes
```

### 2. **Commits**
Usamos a convenção **Conventional Commits** nos commits, seguindo o formato:

```
<tipo>(identificador opcional): descrição do commit
```

Tipos aceitos:
- `feat`: Adicionar nova funcionalidade.
- `fix`: Correção de bugs.
- `chore`: Alterações no ambiente ou tarefas administrativas.
- `refactor`: Refatoração do código sem mudar lógica.
- `style`: Ajustes de estilo ou formatação.
- `test`: Adição ou edição de testes.

Exemplos:
- `feat: adicionar suporte ao pagamento via cartão de crédito`
- `fix: corrigir bug na criação do QR Code`

Se possível, vincule o commit a uma issue usando o `#`:
- `feat: implementar notificação de pagamento (#42)`

---

## Padrões de Branches

Nosso fluxo de trabalho utiliza **Git Flow Simplificado**, com os seguintes padrões de branches:
- A `main` é a principal e sempre estável.
- Use branches descritivas para suas alterações. Os prefixos seguem:
    - **Novas Features:** `feature/nome-da-feature`
    - **Correções (bugfix):** `fix/nome-da-correção`

### Exemplo de Criação de Branch:
```bash
git checkout -b feature/adicionar-pagamento-via-boleto
```

Ao finalizar suas modificações, envie um Pull Request para o repositório.

---

## Testes

A contribuição com testes é muito importante para manter a qualidade do projeto.

### 1. Escrever Testes
- Crie testes unitários para novas funcionalidades em: `tests/Unit/`.
- Crie testes de integração em: `tests/Feature/`.
- Use o **PHPUnit** para escrever seus testes.

### 2. Rodar os Testes
Antes de enviar o código, certifique-se de que os testes estão passando:
```bash
php artisan test
```

Se possível, inclua o seguinte comando no `composer.json` na seção de scripts:
```json
"scripts": {
    "test": "php artisan test"
}
```

Agora, você pode simplesmente rodar:
```bash
composer test
```

---

## Problemas e Sugestões

Antes de reportar um problema ou propor uma funcionalidade, verifique as **issues existentes** para evitar duplicações. Se o problema já existe e você deseja participar da discussão ou correção, comente nela.

Para novos problemas ou ideias:
1. Abra uma nova **issue**.
2. Seja claro e forneça o máximo de informações possíveis:
    - Diga como reproduzir o problema (se relevante).
    - Forneça logs e mensagens de erro.
    - Explique por que a funcionalidade proposta seria útil para o projeto.

---

## Comunicação

Se precisar entrar em contato com os mantenedores:
- Faça perguntas básicas ou gerais via **issues**.
- Entre em contato diretamente via e-mail (se disponibilizado).

---

## Checklist do Pull Request

Antes de enviar um Pull Request, verifique:
- [ ] Seguiu o padrão de código e estilo?
- [ ] Escreveu (ou atualizou) os testes?
- [ ] Todos os testes estão passando?
- [ ] Alterou a documentação (se necessário)?
- [ ] Os commits seguem a convenção do projeto?

Enviou um Pull Request? Não esqueça de descrever bem suas alterações! 😊

---

Muito obrigado por contribuir! 🚀
