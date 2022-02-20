## Desafio-FullStack

Para executar o programa, primeiro passo; criar no seu computador uma base de dados chamada, api.gazin.</br></br>
Segundo passo; abrir o prompt de comando, acessar a pasta do seu localhost e executar os comandos abaixo:

- git clone https://github.com/HeltonPietrangello/ApiGazinTech
- composer install
- php artisan migrate
- php artisan serve

Terceiro passo; accessar esta url http://127.0.0.1:8000.

</br></br></br>
## Endpoinst que não foram implementados no Frontend da API

// Campo de busca
<p>http://127.0.0.1:8000/v1/levels/?filter[level]=COLOCAR AQUI O NOME DO LEVEL QUE DESEJA BUSCAR </p>

// Ordenar por campo
 <p>http://127.0.0.1:8000/v1/levels/?sort=-level</p>

 // Paginação
<p>http://127.0.0.1:8000/v1/levels/?page=2</p>




