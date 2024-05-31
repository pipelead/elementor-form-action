# Pipelead Form Action

## Descrição

O **Pipelead Form Action** é um plugin para o Elementor Pro que adiciona uma nova ação de submissão aos formulários, permitindo que os dados do formulário sejam enviados para um webhook especificado. Este plugin é útil para integrar os formulários do Elementor com a plataforma Pipelead.

## Instalação

1. Faça o download do plugin:
    - [Download Pipelead Form Action v0.0.1](https://github.com/pipelead/elementor-form-action/archive/refs/tags/v0.0.1.zip)

2. Instale o plugin no WordPress:
    - Vá para **Plugins > Adicionar novo** no painel administrativo do WordPress.
    - Clique em **Enviar plugin** e selecione o arquivo `.zip` que você acabou de baixar.
    - Clique em **Instalar agora** e depois em **Ativar** para ativar o plugin.

## Uso

### Configuração do Formulário

1. **Adicione um Formulário no Elementor:**
    - No editor do Elementor, arraste e solte o widget **Form** na sua página.

2. **Configurar a Ação de Webhook:**
    - Nas configurações do formulário, vá para a aba **Actions After Submit**.
    - Adicione a ação **Pipelead Webhook**.
    - Nas configurações da ação **Pipelead Webhook**, insira a URL do webhook na opção **Webhook URL**.

### Obtendo Endpoints dos Formulários no Pipelead

Para integrar seu formulário do Elementor com o Pipelead, você precisa do endpoint do formulário no Pipelead:

1. Vá até o painel do Pipelead.
2. Navegue até a página **Formulários**.
3. Escolha um formulário existente ou crie um novo.
4. Copie o endpoint do formulário.

### Exemplo de Configuração

- **Webhook URL:** `https://app.pipelead.to/webhook/lead/abcdefgh123`