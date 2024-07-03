# ShopExpert

Esse é um simples aplicativo para apresentação de uma plataforma de vendas de produtos, onde você poderá adicionar fácilmente atributos para seu comercio.
Ele já vem com um sistema de Taxas/Impostos que facilita a criação de impostos sobre produto. Além de que cada imposto ou taxa pode ser incluido em diferentes tipos de produto.

# Acesso

Login do Administrador: admin@admin.com
Senha Padrão: 123456

# Instalações

- Docker Compose (Rápida):
    - Baixe a pasta '/docker' do nosso repositório com os arquivos de backup e Dockerfile.
    - Instale o docker e docker-compose em seu ambiente de desenvolvimento.
    - Execute o comandos >_ docker-compose up -d
    - Abra seu navegador na e acesse localhost:8181
    - Pronto você está com ShopExpert funcionando!
- Básica:
    - Baixe em nosso repositório o pacote com os códigos.
    - Armazene em um servidor com Apache ou PHP 7.4 instalados.
    - Caso precise crie uma pasta dentro do projeto com nome storage e dentro logs (storage/logs).
    - Rode os scripts de banco de dados em seu DB recomendamos o Postgres ou você pode usar o backup em /docker/postgres/dump_data.sql.
        >_ psql -d shopexpert -f dump_data.sql (É necessário possuir um usuário root no seu Banco de dados)
    - Execute a instalações de dependencias >_'composer install'.
    - Na pasta do projeto execute >_ php -S 0.0.0.0:8080 -t /var/www/html/shopexpert 
- Docker:
    - docker build -t shopexpert .
    - docker run -it -d --name shopexpert -p 8080:80 shopexpert
    - docker run -it -d --name postgres -p 5432:5432 postgres
    - Configure as informações de acesso ao banco de dados no arquivo config/config.php

# Sobre

- Sistema rotas automaticas, não é preciso se preocupar com arquivos de rotas, pois nosso projeto vem com uma CORE de rotas que identifica seu Controller e a função acessada atravez da URL e já redireciona para a determinada função.
- Validação com Valitron para melhorar os dados a serem armazenados no banco de dados.
- Sistema de login implementado.
- Painel Elegante.
- Icones do FontAwasome.
- Recuperação de Senhas.
- Validação de registros de erros em logs.
