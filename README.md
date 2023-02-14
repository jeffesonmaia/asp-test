#### Pré requisitos do ambiente

* [Docker](https://docs.docker.com/install/linux/docker-ce/debian/).
* [Docker Compose](https://docs.docker.com/compose/install/).

#### Instalação

1. Copiar o .env.exemplo para .env na raiz do projeto

```sh
$ cp .env.exemplo .env
```

2. subir os containers:

```sh
$ docker-compose up -d
```

3. Instalar as dependências do projeto:

```sh
$ docker-compose exec app composer install
``` 

4. Rodar o comando abaixo para que seja criado a tabela que será utilizada:

```
$ docker-compose exec app php vendor/bin/phinx migrate
```

#### Comandos:

1. Cadastrar um usuário:

```sh
$  docker-compose exec app ./ASP-TEST USER:CREATE
```

2. Cadastrar uma senha para o usuário:

```sh
$ docker-compose exec app ./ASP-TEST USER:CREATE-PWD {ID}
```

##### Testes unitários

```sh
$ docker-compose exec app php vendor/bin/phinx migrate 
```