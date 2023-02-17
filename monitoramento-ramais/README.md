Monitoramento de Ramais

Esse é um projeto para monitoramento de ramais telefônicos desenvolvido com PHP, JavaScript, HTML e CSS. O objetivo é apresentar em tempo real o status de cada ramal (disponível ou ocupado, etc) em uma interface simples e fácil de usar.

Requisitos
Para executar esse projeto, você vai precisar de um servidor web e um banco de dados MySQL. As instruções a seguir são para um ambiente de desenvolvimento local usando o WAMP Server.

Instalação
Faça o download do projeto e extraia os arquivos na pasta www do WAMP Server.

Importe o arquivo dump.sql para criar a base de dados e as tabelas necessárias.

Abra o arquivo db_connect.php e configure as informações de conexão com o banco de dados.

Abra o navegador e digite http://localhost/monitoramento-ramais na barra de endereços.

A interface do projeto será carregada com o status dos ramais atualizados em tempo real.

Como funciona
O projeto consiste em um arquivo PHP (ramais.php) que lê os dados dos ramais diretamente dos arquivos 'filas.txt' e 'ramais.txt' usando RegEx e retorna um array JSON com essas informações. Em seguida, um arquivo JavaScript (monitoramento.js) realiza uma requisição AJAX a cada 10 segundos para obter os dados e atualiza a interface e o proprio banco com essas informações.

O arquivo atualiza.php é responsável por atualizar o status dos ramais no banco de dados de acordo com o status atual de cada ramal.