## Desafio-FullStack

Para executar o programa, primeiro passo; criar no seu computador uma base de dados chamada, api.gazin.</br></br>
Segundo passo; no prompt de comando executar os comandos abaixo:

- git clone https://github.com/HeltonPietrangello/api.gazin.git
- composer install
- php artisan migrate

</br></br></br>
## Endpoinst que não foram implementados no Frontend da API

// Campo de busca
<p>http://127.0.0.1:8000/v1/levels/?filter[level]=COLOCAR AQUI O NOME DO LEVEL QUE DESEJA BUSCAR </p>

// Ordenar por campo
 <p>http://127.0.0.1:8000/v1/levels/?sort=-level</p>

 // Paginação
<p>http://127.0.0.1:8000/v1/levels/?page=2</p>




