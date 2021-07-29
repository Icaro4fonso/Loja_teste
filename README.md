# Projeto ApiRest

## Introdução
Nesse projeto, foi desenvolvido uma ApiRest utilizando as ferramentas VsCode, Postman e  banco de dados MySql.

### Etapas para instalação e utilização:
* No terminal do VsCode ou de preferência clone o repositório :
> $ git clone https://github.com/Icaro4fonso/Loja_teste.git
* No Mysql ou banco de dados de preferência crie uma tabela com o nome "loja_teste".
* Abra o projeto, inicie um novo terminal e digite para iniciar a criação de tabelas:
> $ php artisan migrate
* Para iniciar o servidor local:
> $ php artisan serve
* Inicie também o seu banco de dados.

#### Para realizar testes as rotas estão disponiveis no link abaixo (Requisito-Postman):
> https://www.getpostman.com/collections/b5e0829b1cc1aeba976d


### Observações:
* Tente cadastra um produto/estampa/roupa mais de uma vez com os mesmos atributos.
* Tente atualizar uma roupa com atributos de uma roupa ja existente.
* Para a rota "atualizar produto" é necessário que hajam pelo menos 2 roupas e 1 estampa ou 1 roupa e 2 estampas.