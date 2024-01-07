# Gerenciador de Materiais Esportivos do IFRN

## Como Executar

1. Instale o PHP, Composer, SQLite3 e as seguintes extensões: 
    ```bash
    php-common libapache2-mod-php php-cli php-curl php-xml php-mbstring php-xdebug php-sqlite3
    ```

1. Clone ou baixe este repositório.

1. Vá para o diretório deste repositório:
    ```bash
    cd <diretório deste repo>
    ```

1. Instale as bibliotecas necessárias via Composer:
    ```bash
    composer install
    ```

1. Execute as migrações:
    ```bash
    php artisan migrate
    ```
    
1. (Opcional) Popule o banco de dados com dados de exemplo:
    ```bash
    php artisan db:seed
    ```
1. Crie uma aplicação OAuth2 no SUAP e copie o `client_id`.

1. Crie o arquivo `.env` a partir do `.env.example` e preencha o `SUAP_CLIENT_ID=` com o `client_id` da sua aplicação OAuth2 criada no SUAP.

1. Gere a chave da aplicação:
    ```bash
    php artisan key:generate
    ```

1. Execute o servidor Laravel:
    ```bash
    php artisan serve
    ```

## Testes Automáticos

Para executar os testes automáticos, use o comando:
```bash
php artisan test
```

Você pode filtrar os testes por nome, por exemplo:
```bash
php artisan test --filter Material
```
Isso faz com que o artisan execute apenas os testes que incluem `Material` no nome, seja isso uma classe inteira ou um método dentro dela.

Para ver um relatório de cobertura, passe a opção para gerar o relatório:
```bash
php artisan test --coverage
```
Você verá uma pasta `tests/coverage`, que contém o relatório de testes em HTML.
Abra o arquivo `index.html`.


## Colaboradores
#### jul/2023 - jan/2024
Agnaldo Bezerra

Ciro Medeiros - [@ciromdrs](https://github.com/ciromdrs)

Edjane Ramalho

Gabriel Costa - [@gabriel360p](https://github.com/gabriel360p/)

Gabriel Fernandes - [@GabrielVictor1](https://github.com/GabrielVictor1)

Giovanna Tomaz

Mariana Freitas - [@mmvmariana](https://github.com/mmvmariana)