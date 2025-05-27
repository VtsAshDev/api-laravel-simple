# API Laravel Simple

## Descrição

Este projeto é uma API RESTful desenvolvida em Laravel para gerenciamento de produtos. Permite realizar operações de cadastro, listagem, atualização, consulta e remoção de produtos.

## Tecnologias Utilizadas
- PHP ^8.2
- Laravel ^12.x
- MySQL ou SQLite (ajustável via `.env`)
- Vite, TailwindCSS e Axios (front-end opcional)

## Instalação

1. Clone o repositório:
   ```bash
   git clone <url-do-repositorio>
   cd api-laravel-simple
   ```
2. Instale as dependências:
   ```bash
   composer install
   npm install
   ```
3. Configure o arquivo `.env` com as informações do banco de dados.
4. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```
5. Execute as migrations:
   ```bash
   php artisan migrate
   ```
6. (Opcional) Rode o servidor de desenvolvimento:
   ```bash
   php artisan serve
   ```

## Endpoints da API

Todos os endpoints estão disponíveis em `/api/produtos`.

| Método   | Endpoint             | Descrição                        |
|----------|----------------------|----------------------------------|
| GET      | /api/produtos        | Lista todos os produtos          |
| GET      | /api/produtos/{id}   | Detalha um produto específico    |
| POST     | /api/produtos        | Cria um novo produto             |
| PUT      | /api/produtos/{id}   | Atualiza um produto existente    |
| DELETE   | /api/produtos/{id}   | Remove um produto                |

### Exemplo de Payload para Criação/Atualização
```json
{
  "nome": "Produto Exemplo",
  "descricao": "Descrição do produto",
  "valor": 99.90,
  "quantidade": 10,
  "status": true
}
```

### Validações dos Campos
- **nome**: obrigatório, string, 3-100 caracteres, único
- **descricao**: obrigatório, string, 3-100 caracteres
- **valor**: obrigatório, numérico, mínimo 0
- **quantidade**: obrigatório, inteiro, mínimo 0
- **status**: obrigatório, booleano

## Estrutura da Tabela `produtos`
| Campo      | Tipo     | Descrição                |
|------------|----------|--------------------------|
| id         | bigint   | Chave primária           |
| nome       | string   | Nome do produto          |
| descricao  | string   | Descrição do produto     |
| valor      | string   | Valor do produto         |
| quantidade | integer  | Quantidade em estoque    |
| status     | string   | Status (ativo/inativo)   |
| created_at | datetime | Data de criação          |
| updated_at | datetime | Data de atualização      |

## Licença

MIT
