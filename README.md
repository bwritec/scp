# Iniciador de Aplicativos CodeIgniter 4

## O que é CodeIgniter?

CodeIgniter é um framework web PHP full-stack que é leve, rápido, flexível e seguro.
Mais informações podem ser encontradas em [site oficial](https://codeigniter.com).

Este repositório contém um modelo inicial de aplicativo instalável via Composer.
Foi construído a partir de
[repositório de desenvolvimento](https://github.com/codeigniter4/CodeIgniter4).

Mais informações sobre os planos para a versão 4 podem ser encontradas em [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) nos fóruns.

Você pode ler o [user guide](https://codeigniter.com/user_guide/)
correspondente à versão mais recente da estrutura.

## Instalação & atualizações

`composer create-project codeigniter4/appstarter` então `composer update` sempre que
houver uma nova versão do framework.

Ao atualizar, verifique as notas de versão para ver se há alguma alteração que você precise aplicar.
A sua pasta `app`. Os arquivos afetados podem ser copiados ou mesclados de
`vendor/codeigniter4/framework/app`.

## Configurar

Cópie `env` para `.env` e adaptá-los ao seu aplicativo, especificamente ao baseURL
e quaisquer configurações de banco de dados.

## Mudança importante com index.php

`index.php` Não está mais na raiz do projeto! Foi movido para dentro da pasta *public*,
Para maior segurança e separação dos componentes.

Isso significa que você deve configurar seu servidor web para "apontar" para a pasta *public*
do seu projeto, e não para a raiz do projeto. Uma prática melhor seria configurar um host virtual
para apontar para lá. Uma prática ruim seria apontar seu servidor web para a raiz do projeto e
esperar acessar *public/...*, já que o restante da sua lógica e o
framework estão expostos.

**Por favor,** leia o guia do usuário para uma melhor explicação de como o CI4 funciona!

## Gerenciamento de repositório

Usamos o GitHub Issues, em nosso repositório principal, para rastrear **BUGS**
e pacotes de trabalho de **DESENVOLVIMENTO** aprovados.
Nós usamos nosso [forum](http://forum.codeigniter.com) Para fornecer SUPORTE e discutir
SOLICITAÇÕES DE RECURSOS.

Este repositório é um repositório de "distribuição", criado pelo nosso script
de preparação de lançamento. Problemas com ele podem ser relatados em nosso
fórum ou como problemas no repositório principal.

## Requisitos do servidor

É necessário o PHP versão 8.1 ou superior, com as seguintes extensões instaladas:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - A data de fim de vida útil do PHP 7.4 foi 28 de novembro de 2022.
> - A data de fim de vida útil do PHP 8.0 foi 26 de novembro de 2023.
> - Se você ainda estiver usando o PHP 7.4 ou 8.0, atualize imediatamente.
> - A data de fim de vida útil do PHP 8.1 será 31 de dezembro de 2025.

Além disso, certifique-se de que as seguintes extensões estejam habilitadas no seu PHP:

- json (Ativado por padrão - não o desative.)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) se você planeja usar MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) Se você planeja usar a biblioteca HTTP\CURLRequest
