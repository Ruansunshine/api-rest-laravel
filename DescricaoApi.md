# Criando uma API REST com Laravel

Este guia explica como criar uma API RESTful utilizando o framework Laravel. Vamos cobrir desde a configuração do ambiente até a criação de rotas, controladores e migrações para uma tabela de produtos.

---

## Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP** (versão 8.2 ou superior)
- **Composer** (gerenciador de dependências do PHP)
- **Laravel Installer** (opcional, mas recomendado)
- **MySQL** (ou outro banco de dados de sua preferência)

---

## Passo 1: Configuração do Ambiente

```bash
php -v
composer -V
```

## Passo 2: Criando um Novo Projeto Laravel

Para criar um novo projeto Laravel, execute o seguinte comando:

```bash
composer create-project --prefer-dist laravel/laravel minha-api
```

Isso criará um novo diretório chamado `minha-api` com a estrutura básica do Laravel.

## Passo 3: Configurando o Banco de Dados

Abra o arquivo `.env` no diretório do projeto e configure as credenciais do banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

## Passo 4: Executando Migrações

O Laravel já vem com migrações padrão para criar tabelas como `users`, `cache` e `jobs`. Para executar essas migrações, use o comando:

```bash
php artisan migrate
```

## Passo 5: Criando uma Migração para a Tabela de Produtos

Vamos criar uma migração para a tabela `produtos`. Execute o seguinte comando:

```bash
php artisan make:migration create_produtos_table
```

Isso criará um arquivo de migração na pasta `database/migrations`. Edite o arquivo para definir as colunas da tabela:

```php
public function up()
{
    Schema::create('produtos', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->text('descricao')->nullable();
        $table->decimal('preco', 8, 2);
        $table->integer('estoque');
        $table->timestamps();
    });
}
```

Execute a migração:

```bash
php artisan migrate
```

## Passo 6: Criando o Modelo e Controlador

Para criar o modelo `Produto` e o controlador `ProdutoController`, execute o seguinte comando:

```bash
php artisan make:model Produto -mcr
```

### Nome da Tabela

Por padrão, o Laravel assume que o nome da tabela é o plural do nome do modelo em inglês. Para definir explicitamente o nome da tabela como `produtos`, adicione a seguinte propriedade no modelo `Produto`:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    // Define o nome da tabela como "produtos"
    protected $table = 'produtos';
}
```

## Passo 7: Definindo Rotas da API

Abra o arquivo `routes/api.php` e defina as rotas para a API de produtos:

```php
use App\Http\Controllers\ProdutoController;

Route::apiResource('produtos', ProdutoController::class);
```

Isso criará automaticamente as rotas para:

- **Listar todos os produtos** (GET `/api/produtos`).
- **Mostrar um produto específico** (GET `/api/produtos/{id}`).
- **Criar um novo produto** (POST `/api/produtos`).
- **Atualizar um produto** (PUT `/api/produtos/{id}`).
- **Excluir um produto** (DELETE `/api/produtos/{id}`).

## Passo 8: Implementando o Controlador

No arquivo `ProdutoController.php`, adicione os métodos para manipular as operações da API:

```php
namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Listar todos os produtos
    public function index()
    {
        return Produto::all();
    }

    // Mostrar um produto específico
    public function show($id)
    {
        return Produto::findOrFail($id);
    }

    // Criar um novo produto
    public function store(Request $request)
    {
        return Produto::create($request->all());
    }

    // Atualizar um produto
    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());
        return $produto;
    }

    // Excluir um produto
    public function destroy($id)
    {
        Produto::destroy($id);
        return response()->noContent();
    }
}
```

## Passo 9: Testando a API

Inicie o servidor de desenvolvimento:

```bash
php artisan serve
```

A API estará disponível em `http://localhost:8000/api/produtos`. Use ferramentas como **Postman** ou **Insomnia** para testar as rotas.

## Passo 10: Conclusão

Neste guia, criamos uma API RESTful com Laravel para gerenciar produtos. A partir daqui, você pode expandir a funcionalidade, adicionar autenticação, validação de dados e muito mais. O Laravel oferece uma base sólida para construir APIs escaláveis e eficientes.
