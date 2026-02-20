<h1 align="center"> MIB Platform  </h1>

<h3 align="center"> Sistema de Vendas e Gerenciamento de VIP para Comunidades de Hell Let Loose </h3>

<div align="center">

<img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"/> 
<img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"/> 
<img src="https://img.shields.io/badge/MySQL-8-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"/> 
<img src="https://img.shields.io/badge/phpMyAdmin-5-FC1C28?style=for-the-badge&logo=phpmyadmin&logoColor=white" alt="phpMyAdmin"/> 
<img src="https://img.shields.io/badge/Docker-Containerized-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker"/> 
<img src="https://img.shields.io/badge/Status-Em%20Desenvolvimento-yellow?style=for-the-badge" alt="Status"/> 

</div>

## 🏆 Sobre o Projeto

O **MIB Platform** é uma aplicação web construída com Laravel, projetada para gerenciar vendas de acessos VIP e automatizar pagamentos via Pix para os servidores da MIB no **Hell Let Loose**.

---

## 🛠 Stack Tecnológica

### Backend
- PHP 8+
- Laravel 12+

### Frontend
- Blade
- TailwindCSS
- Vite

### Banco de Dados
- SQLite (desenvolvimento)
- MySQL / PostgreSQL (produção)

### Infraestrutura
- Docker
- Docker Compose
- Nginx
- Filas

## Requisitos

- Docker & Docker compose
- NodeJs
- Conta [Mercado Pago Developers](https://www.mercadopago.com.br/developers)

## Como  Subir o ambiente

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/1Rhuan/MIB.git
```
```sh
cd MIB
```

Suba os containers do projeto
```sh
docker compose up -d
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

No `.env` defina suas credencias
```sh
APP_NAME=
APP_URL=

MERCADOPAGO_ACCESS_TOKEN=
MERCADOPAGO_WEBHOOK_SECRET=

DISCORD_WEBHOOK_URL=
DISCORD_INVITE_URL=

YOUTUBE_CHANNEL_URL=
```


No linux de permissão
```sh
sudo chmod -R 777 .
```

Acesse o container app
```sh
docker compose exec app bash
```

Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```

OPCIONAL: Gere o banco SQLite (caso não use o banco MySQL)
```sh
touch database/database.sqlite
```

Rodar as migrations
```sh
php artisan migrate
```

Iniciar a fila
```sh
nohup php artisan queue:work > storage/logs/queue.log 2>&1 &
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)
