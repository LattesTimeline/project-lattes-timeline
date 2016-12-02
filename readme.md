# Lattes Timeline
*****************
- 1. [Introdução](#lt_introducao)
	- 1.1. [Finalidade](#lt_finalidade)
- [Controllers](#controllers)
	- [lt_index.php](#lt_index)
	- [lt_uploader.php](#lt_uploader)
	- [lt_timeline_generator.php](#lt_timeline_generator)

- [Libraries](#libraries)
	- [MY_LT_LIB.php](#MY_LT_LIB)

- [Views](#views)
	- [lt_index.php](#view_lt_index)
	- [lt_timeline.php](#view_lt_timeline)
	- [Chart](#view_chart)
		- [lt_chart.php](#view_lt_chart)
	- [Errors](#view_errors)
	- [Subviews](#view_subviews)
		- [lt_timeline_content.php](#view_lt_timeline_content)
		- [lt_timeline_content_year_boards.php](#view_lt_timeline_content_year_boards)
		- [lt_timeline_content_year_orientations.php](#view_lt_timeline_content_year_orientations)
		- [lt_timeline_content_year_productions.php](#view_lt_timeline_content_year_productions)
		- [lt_timeline_content_year_projects.php](#view_lt_timeline_content_year_projects)
		- [lt_timeline_content_years.php](#view_lt_timeline_content_years)
		- [lt_timeline_filter.php](#view_lt_timeline_filter)
	- [Template](#view_template)
		- [lt_header.php](#view_lt_header)
		- [lt_menu.php](#view_lt_menu)
		- [lt_footer.php](#view_lt_footer)


## <a id="#lt_introducao">Introdução</a>

Lattes Timeline é uma aplicação Web para visualização de currículos da plataforma Lattes do CNPQ, em formato XML.
É possível visualizar as publicações do currículo em um formato de linha do tempo, todas organizadas por ano e tipos.
Também pode-se visualizar um gráfico interativo com a quantidade de publicações por ano.


## <a id="#lt_finalidade">Finalidade</a>



## Informações de Versão

Repositório do código de desenvolvimento. Para baixar a última versão,
acesse o link [Lattes Timeline](https://bitbucket.org/GShiki/lattes-timeline).


## Requerimentos de Servidor

[PHP versão 5.4](https://www.php.net/) (recomendado) ou versão mais nova.


## Instalação

Para entender melhor o processo de instalação, veja como instalar o framework em PHP CodeIgniter no 
seguinte link : [Guia de Instalação CodeIgniter](http://www.codeigniter.com/user_guide/installation/index.html).


## Licença

Necessário ler também a licença do arquivo license.txt dentro desse projeto.

O software se utiliza da licença GPL - General Public License - visa garantir quatro liberdades básicas ao usuário desse programa :

1. A liberdade de executar o programa, para qualquer propósito
2. A liberdade de estudar como o programa funciona e adaptá-lo para as suas necessidades
3. A liberdade de redistribuir cópias de modo que você possa ajudar ao seu próximo
4. A liberdade de aperfeiçoar o programa, e liberar os seus aperfeiçoamentos, de modo que toda a comunidade se beneficie deles


## Recursos

-  [Guia do Usuário do CodeIgniter](http://www.codeigniter.com/docs)
-  [Forums do CodeIgniter](http://forum.codeigniter.com/)
-  [Wiki do CodeIgniter](https://github.com/bcit-ci/CodeIgniter/wiki)
-  [Comunidade IRC do CodeIgniter](http://www.codeigniter.com/irc)
-  [JQuery API](http://api.jquery.com/)
-  


## Guia de Utilização do Software
*********************************

Para ...


## Guia do Desenvolvedor
************************




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

Arquivos que codificam as views da aplicação (páginas).

- <a id="view_lt_index">lt_index</a>

>  View que representa a página inicial.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="view_lt_timeline">lt_timeline</a>

>  View que representa a estrutura geral de visualização da timeline.
> <br><br>
> CRIADOR : Felipe Chagas


## <a id="view_chart">Chart</a>

Arquivos que codificam as views de visualização dos gráficos.

- <a id="view_lt_chart">lt_chart</a>

>  View que representa o modal de visualização do gráfico.
> <br><br>
> CRIADOR : Felipe Chagas


## <a id="view_errors">Errors</a>

Arquivos que codificam as views de erros da aplicação.


## <a id="view_subviews">Subviews</a>

Arquivos que codificam as subviews da aplicação. Cada subview representa uma
parte da aplicação.

- <a id="view_lt_timeline_content">lt_timeline_content</a>

>  Subview que representa a estrutura geral da timeline.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="view_lt_timeline_content_year_boards">lt_timeline_content_year_boards</a>

>  Subview que representa a parte de bancas de jurado.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="view_lt_timeline_content_year_orientations">lt_timeline_content_year_orientations</a>

>  Subview que representa a parte de orientações.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="view_lt_timeline_content_year_productions">lt_timeline_content_year_productions</a>

>  Subview que representa a parte de produções.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="view_lt_timeline_content_year_projects">lt_timeline_content_year_projects</a>

>  Subview que representa a parte de projetos.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="view_lt_timeline_content_years">lt_timeline_content_years</a>

>  Subview que representa a parte da página com os anos de publicações.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="view_lt_timeline_filter">lt_timeline_filter</a>

>  Subview que representa a parte da página com os filtros.
> <br><br>
> CRIADOR : Felipe Chagas


## <a id="view_template">Template</a>

Arquivos que codificam as partes do template das páginas.

- <a id="view_lt_header">lt_header</a>

>  Template com o cabeçalho.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="view_lt_menu">lt_menu</a>

>  Template com o menu.
> <br><br>
> CRIADOR : Felipe Chagas

- <a id="view_lt_footer">lt_footer</a>

>  Template com o rodapé.
> <br><br>
> CRIADOR : Felipe Chagas
