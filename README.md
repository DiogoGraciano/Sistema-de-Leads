# 🏨 Sistema de Gestão de Leads para Hotéis

Sistema web completo para gestão de leads e hotéis, desenvolvido com Laravel 12, oferecendo uma API REST robusta e interface web intuitiva.

## 🎯 Sobre o Projeto

Este sistema foi desenvolvido como projeto freelancer para a **Harmonika Games**, atendendo às necessidades específicas de gestão de leads e hotéis da empresa.

## 📋 Funcionalidades

### 🔐 Autenticação
- Login/Logout de usuários
- Registro de novos usuários
- Autenticação via Laravel Sanctum (API Tokens)

### 🏨 Gestão de Hotéis
- Cadastro, edição e listagem de hotéis
- Visualização detalhada de cada hotel
- Associação de leads aos hotéis

### 👥 Gestão de Leads
- Cadastro completo de leads com:
  - Nome do cliente
  - Telefone de contato
  - Email
  - Data da consulta
  - Número do quarto solicitado
  - Questões/observações
- Listagem e busca de leads
- Exportação de dados
- Associação de leads aos hotéis

### 📊 Relatórios
- Resumo geral de leads
- Relatórios por hotel
- Exportação de dados para análise

### 🌐 Interface
- Interface web completa com Blade templates
- API REST para integração com aplicações externas
- Collection do Postman incluída para testes da API

## 🚀 Tecnologias Utilizadas

- **Backend**: Laravel 12 (PHP 8.2+)
- **Banco de Dados**: PostgreSQL 17
- **Cache**: Redis 8
- **Autenticação**: Laravel Sanctum
- **Containerização**: Docker & Docker Compose
- **Frontend**: Blade Templates, CSS, JavaScript
- **Testes**: PHPUnit

## 📦 Pré-requisitos

- Docker e Docker Compose
- Git

## 🛠️ Instalação e Configuração

### 1. Clone o repositório
```bash
git clone <url-do-repositorio>
cd ohnmacht
```

### 2. Suba os containers
```bash
docker-compose up -d
```

### 3. Configure a aplicação
```bash
# Acesse o container PHP
docker-compose exec php bash

# Instale as dependências
composer install

# Configure o ambiente
cp .env.example .env
php artisan key:generate

# Execute as migrações e seeders
php artisan migrate --seed

# Instale dependências do frontend (se necessário)
npm install
npm run build
```

### 4. Acesse a aplicação
- **Web Interface**: http://localhost
- **API**: http://localhost/api
- **Banco de Dados**: localhost:5432
- **Redis**: localhost:6379

## 🔧 Configuração do Ambiente

### Variáveis de Ambiente (.env)
```env
APP_NAME="Ohnmacht"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=postgres

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## 📡 API Endpoints

### Autenticação
```http
POST /api/login          # Login
POST /api/logout         # Logout (requer auth)
GET  /api/user           # Dados do usuário (requer auth)
POST /api/register       # Registro (requer auth)
```

### Hotéis
```http
GET    /api/hotels       # Listar hotéis
POST   /api/hotels       # Criar hotel
GET    /api/hotels/{id}  # Visualizar hotel
PUT    /api/hotels/{id}  # Atualizar hotel
DELETE /api/hotels/{id}  # Deletar hotel
```

### Leads
```http
GET    /api/leads        # Listar leads
POST   /api/leads        # Criar lead
GET    /api/leads/{id}   # Visualizar lead
PUT    /api/leads/{id}   # Atualizar lead
DELETE /api/leads/{id}   # Deletar lead
GET    /api/leads-export # Exportar leads
```

### Relatórios
```http
GET /api/reports/summary     # Resumo geral
GET /api/reports/by-hotel    # Relatório por hotel
```

### Testando a API
Importe a collection `Ohnmacht_API.postman_collection.json` no Postman para testar todos os endpoints.

## 🗄️ Estrutura do Banco de Dados

### Tabela: users
- id, name, email, password, timestamps

### Tabela: hotels
- id, name, timestamps

### Tabela: leads
- id, name, phone, email, date, hotel_id, nr_room, question, timestamps

## 🧪 Executando Testes

```bash
# No container PHP
php artisan test

# Ou usando composer
composer test
```

## 📁 Estrutura de Pastas

```
ohnmacht/
├── docker/                 # Configurações Docker
├── src/                    # Código fonte Laravel
│   ├── app/
│   │   ├── Http/Controllers/
│   │   │   ├── Api/        # Controllers da API
│   │   │   └── ...         # Controllers Web
│   │   └── Models/         # Modelos Eloquent
│   ├── database/
│   │   ├── migrations/     # Migrações do banco
│   │   ├── seeders/        # Seeders
│   │   └── factories/      # Factories para testes
│   ├── routes/
│   │   ├── api.php         # Rotas da API
│   │   └── web.php         # Rotas web
│   └── resources/views/    # Templates Blade
└── docker-compose.yml      # Orquestração dos containers
```

## 🐳 Comandos Docker Úteis

```bash
# Subir os serviços
docker-compose up -d

# Ver logs
docker-compose logs -f

# Acessar container PHP
docker-compose exec php bash

# Parar os serviços
docker-compose down

# Rebuild dos containers
docker-compose up --build
```

## 🔄 Desenvolvimento

### Comandos Laravel úteis
```bash
# Migrations
php artisan migrate
php artisan migrate:rollback
php artisan migrate:fresh --seed

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Desenvolvimento
php artisan serve
php artisan queue:listen
php artisan tinker
```

## 📝 Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.