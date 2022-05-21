# :rocket: Teste desenvolvedor Backend - increazy


## 🤔 Desafio
Criar uma API utilizando Lumen ou Laravel com uma rota de `/search/local/` onde é passado como query params um ou vários ceps e com isso acontece a busca na API do [ViaCEP](https://viacep.com.br/) para buscar as informações correspondentes a cada cep e retornar em forma de json.

## Como usar a API

#### :computer:  Localhost
*Necessário ter o PHP, e o Composer instalado.*
- Clonar esse repositório.
- Na pasta do repositório rodar o comando `composer install` para instalar as dependências da API.
- Rodar o comando `php -S localhost:8000 -t -public` para abrir o servidor local na porta 8000

Apos isso só fazer começar a utilizar :sunglasses:


#### <img src="https://www.herokucdn.com/favicons/favicon.ico" width="20">eroku

Para utilizar a API hospedada na heroku basta passar ceps para esse link: https://buscarceps.herokuapp.com/search/local/

#### Exemplo de request

**URL** : `/search/local/$ceps`
**Ex** :  `https://buscarceps.herokuapp.com/search/local/44051682,44023252,1123111,333456, ...`


#####Response

```json
[
    {
    "cep": "xxxxx-xxx",
    "logradouro": "lorem inspur",
    "complemento": "lorem inspur",
    "bairro": "lorem inspur",
    "localidade": "lorem inspur",
    "uf": "lorem inspur",
    "ibge": "lorem inspur",
    "gia": "",
    "ddd": "xx",
    "siafi": "xxxx"
    },
    {
    "cep": "xxxxx-xxx",
    "logradouro": "lorem inspur",
    "complemento": "lorem inspur",
    "bairro": "lorem inspur",
    "localidade": "lorem inspur",
    "uf": "lorem inspur",
    "ibge": "lorem inspur",
    "gia": "",
    "ddd": "xx",
    "siafi": "xxxx"
    }

]

```
