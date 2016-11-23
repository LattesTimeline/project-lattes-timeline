# Lattes Timeline
*****************

Lattes Timeline é uma aplicação Web para visualização de currículos da plataforma Lattes do CNPQ, em formato XML.
É possível visualizar as publicações do currículo em um formato de linha do tempo, todas organizadas por ano e tipos.
Também pode-se visualizar um gráfico interativo com a quantidade de publicações por ano.


## Informações de Versão
************************

Repositório do código de desenvolvimento. Para baixar a última versão,
acesse o link [Lattes Timeline](https://bitbucket.org/GShiki/lattes-timeline).


## Requerimentos de Servidor
****************************

[PHP versão 5.4](https://www.php.net/) (recomendado) ou versão mais nova.


## Instalação
*************

Para entender melhor o processo de instalação, veja como instalar o framework em PHP CodeIgniter no 
seguinte link : [Guia de Instalação CodeIgniter](http://www.codeigniter.com/user_guide/installation/index.html).


## Licença
**********

Necessário ler também a licença do arquivo license.txt dentro desse projeto.

O software se utiliza da licença GPL - General Public License - visa garantir quatro liberdades básicas ao usuário desse programa :

1. A liberdade de executar o programa, para qualquer propósito
2. A liberdade de estudar como o programa funciona e adaptá-lo para as suas necessidades
3. A liberdade de redistribuir cópias de modo que você possa ajudar ao seu próximo
4. A liberdade de aperfeiçoar o programa, e liberar os seus aperfeiçoamentos, de modo que toda a comunidade se beneficie deles


## Recursos
***********

-  [Guia do Usuário do CodeIgniter](http://www.codeigniter.com/docs)
-  [Forums do CodeIgniter](http://forum.codeigniter.com/)
-  [Wiki do CodeIgniter](https://github.com/bcit-ci/CodeIgniter/wiki)
-  [Comunidade IRC do CodeIgniter](http://www.codeigniter.com/irc)


## Guia de Utilização do Software
*********************************

Para ...


## Guia do Desenvolvedor
************************

- [Controllers](#controllers)
	- lt_index.php
	- lt_timeline_generator.php
	- lt_uploader.php

- [Libraries](#libraries)
	- [MY_LT_LIB.php](#MY_LT_LIB.php)

- [Views](#views)


## <a id="controllers">Controllers</a>

Classes responsáveis pela funcionalidade de controle da aplicação.


## <a id="libraries">Libraries</a>

Classes de biblioteca 

## <a id="MY_LT_LIB.php">MY_LT_LIB</a>

> CRIADOR : Felipe Chagas
> DESCRIÇÃO : Arquivo criado para conter as funcionalidades princi-
> pais da aplicacao. Tais como : carregamento do arquivo de interna-
> cionalizacao, consulta do arquivo XML, processamento dos NODE's do 
> arquivo XML, etc. Essa é a principal biblioteca da aplicação.
