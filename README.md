## Desafio-FullStack

Para executar o programa, favor criar no seu computador uma base de dados chamada, api.gazin.
Segundo passo, no prompt de comando executar os comandos abaixo:

- git clone https://github.com/HeltonPietrangello/api.gazin.git
- composer install
- php artisan migrate


## Endpoinst que não foram implementados no Frontend da API

// Campo de busca
http://127.0.0.1:8000/v1/levels/?filter[level]=COLOCAR AQUI O NOME DO LEVEL QUE DESEJA BUSCAR 

// Ordenar por campo
 http://127.0.0.1:8000/v1/levels/?sort=-level

 // Paginação
http://127.0.0.1:8000/v1/levels/?page=2




