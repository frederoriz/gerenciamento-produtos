# README - Instalação do Projeto

## 📋 Pré-requisitos

- PHP 8.3
- Composer 2.5+
- Laravel 11
- SQLite (para banco de dados local)

## 🚀 Instalação Local

Siga estes passos para configurar o projeto em sua máquina:

### 1. Clonar o repositório
```bash
git clone [URL_DO_REPOSITORIO]
cd [NOME_DO_PROJETO]
```

### 2. Configurar ambiente

#### Criar arquivo do banco SQLite:
```bash
touch database/database.sqlite
```

#### Configurar arquivo .env:
```bash
cp .env.example .env
```

Edite o `.env` e configure:
```ini
DB_CONNECTION=sqlite
```

#### Gerar chave da aplicação:
```bash
php artisan key:generate
```

### 3. Instalar dependências
```bash
composer install
```

### 4. Banco de dados e dados iniciais
```bash
php artisan migrate:fresh --seed
```

### 5. Iniciar ambiente de desenvolvimento
```bash
npm run dev
```

### 6. Iniciar servidor local
```bash
php artisan serve
```

## 🔑 Acesso ao Sistema

Use as seguintes credenciais para login:

- **Email:** `admin@growth.com`
- **Senha:** `admin`