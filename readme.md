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
	- [lt_index.php](#lt_index)
	- [lt_uploader.php](#lt_uploader)
	- [lt_timeline_generator.php](#lt_timeline_generator)

- [Libraries](#libraries)
	- [MY_LT_LIB.php](#MY_LT_LIB)

- [Views](#views)
	- [Subviews](#subviews)
		- [lt_chart.php](#lt_chart)
		- [lt_timeline_content.php](#lt_timeline_content)
		- [lt_timeline_content_year_boards.php](#lt_timeline_content_year_boards)
		- [lt_timeline_content_year_orientations.php](#lt_timeline_content_year_orientations)
		- [lt_timeline_content_year_productions.php](#lt_timeline_content_year_productions)
		- [lt_timeline_content_year_projects.php](#lt_timeline_content_year_projects)
		- [lt_timeline_content_years.php](#lt_timeline_content_years)
		- [lt_timeline_filter.php](#lt_timeline_filter)


## <a id="controllers">Controllers</a>

Classes responsáveis pela funcionalidade de controle da aplicação.

- <a id="lt_index">lt_index</a>

>  Controller responsavel pela inicialização da aplicação e a 
> construção da página inicial.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="lt_uploader">lt_uploader</a>

>  Controller responsável pelo carregamento do arquivo XML 
> Realiza a movimentação do arquivo do local temporário para um local 
> permanente.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="lt_timeline_generator">lt_timeline_generator</a>

>  Controller responsável pela leitura do arquivo XML, já 
> carregado através do controller LT_UPLOADER. Também faz a chamada 
> dos métodos de consulta dos NODE's e atributos, para colocá-los 
> em sessão. Ao final, faz o carregamento da página da Timeline.
> <br><br>
> CRIADOR : Felipe Chagas


## <a id="libraries">Libraries</a>

Classes de biblioteca...

- <a id="MY_LT_LIB">MY_LT_LIB</a>

>   Arquivo criado para conter as funcionalidades princi-
> pais da aplicacao. Tais como : carregamento do arquivo de interna-
> cionalizacao, consulta do arquivo XML, processamento dos NODE's do 
> arquivo XML, etc. Essa é a principal biblioteca da aplicação.
> <br><br>
> CRIADOR : Felipe Chagas


## <a id="views">Views</a>
