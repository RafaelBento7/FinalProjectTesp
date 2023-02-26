# TESP-PSI-2-Ano-1-Semestre-PLSI-SIS

Grupo B
2211893 - Pedro Henriques
2211904 - Pedro Norberto
2211900 - Rafael Bento

## Instruções 
1. Executar o script SQL "aerocontrol/db/tabelas.sql" (Em caso de erro, ir às definções do MySQL e alterar o "innodb-default-row-format" para "dynamic").
2. Executar o script SQL "aerocontrol/db/registos.sql"
3. Abrir o projeto, abrir o terminal e executar o "composer install" na base do projeto (pasta aerocontrol);
4. Executar o comando ".\yii migrate --migrationPath=@yii/rbac/migrations" no terminal.
5. Executar o comando ".\yii migrate" no terminal
6. Dentro do projeto alterar o ficheiro "main.php" da pasta "common", dentro dos "components", no "UrlManagerFrontEnd" alterar o "baseUrl" para o caminho no qual se encontra o projeto no servidor.

## Instruções para execução dos testes
O projeto vai enviado em modo de produção, porém para a execução dos testes é necessário executar o comando "php init" e selecionar o "1- Production" para que os testes possam ser executados.

### Teste Unitários
>php vendor/bin/codecept run unit -c common

>php vendor/bin/codecept run unit -c frontend

### Teste Funcionais
>php vendor/bin/codecept run functional -c backend

>php vendor/bin/codecept run functional -c frontend



## Credenciais

### Admin

>username: Rafael
password: 12345678

### Funcionários

> username: Pedro
password: 12345678

>username: Manuel
password: 12345678

### Cliente

>username: antonio
password: 12345678

>username: joaquim
password: 12345678

### Gerente

>username: santos
password: 12345678

*Existem mais funcionários e clientes como é possivel ver na BD, para efetuar o login com qualquer um dos funcionários ou clientes a password é "12345678"*