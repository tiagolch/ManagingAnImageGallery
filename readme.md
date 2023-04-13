# Galeria de Imagens

Este projeto é uma galeria de imagens que utiliza a API do Flickr para exibir imagens de gatinhos ou de uma busca. O projeto é desenvolvido em PHP e utiliza uma classe SingletonImagesDB para criar e gerenciar um banco de dados SQLite para armazenar as informações das imagens exibidas na galeria.

## Requisitos

- Versão do PHP >= 5.3


## Configuração

- Abra o arquivo `index.php`e configure a chave de API do Flickr, as tags de pesquisa, a quantidade de fotos por página e a página de busca, conforme necessário. Você pode alterar os valores das variáveis `$apiKey`, `$tags`, `$perPage` e `$page` na primeira parte do arquivo `index.php`.
- Rode seguinte comando para executar o projeto no navegador

        php -S 127.0.0.1:8000


## Estrutura do Projeto

O projeto é composto pelos seguintes arquivos:

- `index.php`: É o arquivo principal do projeto que exibe a galeria de imagens. Ele inclui os arquivos db.php e api.php para acessar o banco de dados e a API do Flickr, respectivamente. Ele também insere os dados das imagens obtidas da API no banco de dados.
- `db.php`: É o arquivo que contém a classe SingletonImagesDB responsável por criar e gerenciar o banco de dados SQLite. Ele possui métodos para criar a tabela de imagens, inserir as imagens no banco de dados e fechar a conexão com o banco de dados.
- `api.php`: É o arquivo que contém a classe FlickrAPI responsável por fazer a busca das imagens na API do Flickr. Ele possui um método `getPhotos()` que retorna um array com as informações das imagens obtidas da API.
