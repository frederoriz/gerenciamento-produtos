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
git clone https://github.com/frederoriz/gerenciamento-produtos.git
```

### 2. Instalar dependências
```bash
composer install
```

### 3. Configurar ambiente

#### Instalar versão correta do php 8.3 
```bash
sudo apt install php8.3-intl
```

#### Instalar sqlite3 
```bash
sudo apt install php8.3-sqlite3
```

#### Instalar bcmath
```bash
sudo apt install php8.3-bcmath
```


#### Instalar npm
```bash
npm install
```

#### Configurar arquivo .env:
```bash
cp .env.example .env
```

#### Gerar chave da aplicação:
```bash
php artisan key:generate
```

### 4. Banco de dados e dados iniciais
```bash
php artisan migrate --seed
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

Acesse a URL em "http://127.0.0.1:8000" ou "http://localhost:8000"

Use as seguintes credenciais para login:

- **Email:** `admin@growth.com`
- **Senha:** `admin`