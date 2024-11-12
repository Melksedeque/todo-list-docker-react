# ToDo List com Docker, PHP, MySQL e React

Este é um projeto de exemplo de uma aplicação de Todo List utilizando PHP no backend, React no frontend e MySQL como banco de dados, tudo rodando em containers Docker. O projeto foi desenvolvido como um estudo para aprender sobre Docker e integração de diferentes tecnologias.

## Pré-requisitos

- **Docker** e **Docker Compose** instalados no sistema.

## Configuração do Projeto

### Clonar o Repositório

Primeiro, clone o repositório para sua máquina local:

```bash
git clone https://github.com/seu-usuario/todo-list-docker-react.git
cd todo-list-docker-react
```

### Estrutura do Projeto

- **backend/**: Contém o código PHP do backend e o `Dockerfile` para configurar o ambiente PHP.
- **docker-compose.yml**: Arquivo de configuração do Docker Compose que define os serviços para o backend em PHP e o banco de dados MySQL.
- **frontend/**: Diretório para o frontend em React (ainda será implementado).

### Configuração e Inicialização dos Containers

Para iniciar o projeto, use o Docker Compose:

```bash
docker-compose up -d --build 
# Eu gosto de utilizar o "-d" para a build rodar em segundo plano e eu permaneça com acesso ao Terminal
```

Esse comando irá:

1. **Construir e iniciar o container do backend (PHP)**.
2. **Iniciar o container do banco de dados (MySQL)** com as configurações especificadas.

### Variáveis de Ambiente

As credenciais e o banco de dados são configurados no `docker-compose.yml`:

- **Banco de dados**: `todo_list`
- **Usuário**: `todo_user`
- **Senha**: `todo_pass`

### Endpoints da API

A API permite realizar operações básicas de CRUD (Create, Read, Update, Delete) em tarefas.

- **GET /** - Lista todas as tarefas.
- **POST /** - Adiciona uma nova tarefa. Exemplo de body JSON:
  ```json
  {
    "title": "Aprender Docker e MySQL"
  }
  ```
- **PUT /?id={id}** - Atualiza o status de uma tarefa (marcar como concluída).
- **DELETE /?id={id}** - Exclui uma tarefa.

### Exemplo de Requisições

Aqui estão alguns exemplos de como interagir com a API usando `curl`:

- **Criar uma tarefa**:
  ```bash
  curl -X POST http://localhost:8000 -H "Content-Type: application/json" -d "{"title":"Aprender Docker e MySQL"}"
  ```

- **Listar todas as tarefas**:
  ```bash
  curl -X GET http://localhost:8000
  ```

- **Atualizar o status de uma tarefa**:
  ```bash
  curl -X PUT "http://localhost:8000?id=1" -H "Content-Type: application/json" -d "{"completed":1}"
  ```

- **Excluir uma tarefa**:
  ```bash
  curl -X DELETE "http://localhost:8000?id=1"
  ```

## Próximos Passos

- Implementar o frontend em React para interagir com o backend.
- Melhorar a documentação com instruções para o frontend.

## Contribuição

Se você deseja contribuir com este projeto, sinta-se à vontade para abrir uma *issue* ou enviar um *pull request*.

---

## Licença

Este projeto é apenas para fins educacionais e de estudo. Sinta-se à vontade para utilizá-lo como base para aprender Docker, PHP e React.
