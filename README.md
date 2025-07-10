### Backend (Laravel)
- ##### PHP ≥ 8.1
- ##### Composer
- ##### MySQL 
- ##### Extensões PHP como pdo, mbstring, openssl, etc.

----

### ⚙️ Etapas para Rodar a API
#### 1. Clone o repositório Laravel
##### `git clone https://github.com/joalisson-p-maia/sync360-io-backend`
##### `cd sync360-io-backend`

#### 2. Instale as dependências
##### `composer install`

#### 3. Crie o arquivo .env
##### `copy .env.example .env`

#### 4. Configure o .env
##### Edite as variáveis:

```javascript 
APP_NAME=Laravel
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=root
DB_PASSWORD=senha
```

#### 5. Gere a chave da aplicação
##### `php artisan key:generate`

#### 6. Execute as migrations
##### `php artisan migrate`

#### 7. Rode o servidor de desenvolvimento
##### `php artisan serve`

##### Por padrão, será iniciado em:
📍 http://localhost:8000