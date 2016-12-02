# Lattes Timeline
*****************
- 1. [Introdução](#lt_introducao)
	- 1.1. [Finalidade](#lt_finalidade)
	- 1.2. [Vocabulário](#lt_vocabulario)
	- 1.3. [Informações de Versão](#lt_versao)
	- 1.4. [Requerimentos de Servidor](#lt_requerimentos)
	- 1.5. [Instalação](#lt_instalacao)
	- 1.6. [Licença](#lt_licenca)
	- 1.7. [Recursos](#lt_recursos)
- 2. [Visão de Casos de Uso](#lt_visao_casos_uso)
	- 2.1. [Visualizar Timeline de Currículo](#lt_visualizar_timeline_curriculo)
	- 2.2. [Visualizar Gráfico de Publicações de Currículo](#lt_visualizar_grafico_publicacoes_curriculo)
- 3. [Visão Lógica](#lt_visao_logica)
	- 3.1. [Model](#lt_model)
	- 3.2. [View](#lt_view)
		- 3.2.1. [lt_index.php](#view_lt_index)
		- 3.2.2. [lt_timeline.php](#view_lt_timeline)
		- 3.2.3. [Chart](#view_chart)
			- 3.2.3.1. [lt_chart.php](#view_lt_chart)
		- 3.2.4. [Errors](#view_errors)
		- 3.2.5. [Subviews](#view_subviews)
			- 3.2.5.1. [lt_timeline_content.php](#view_lt_timeline_content)
			- 3.2.5.2. [lt_timeline_content_year_boards.php](#view_lt_timeline_content_year_boards)
			- 3.2.5.3. [lt_timeline_content_year_orientations.php](#view_lt_timeline_content_year_orientations)
			- 3.2.5.4. [lt_timeline_content_year_productions.php](#view_lt_timeline_content_year_productions)
			- 3.2.5.5. [lt_timeline_content_year_projects.php](#view_lt_timeline_content_year_projects)
			- 3.2.5.6. [lt_timeline_content_years.php](#view_lt_timeline_content_years)
			- 3.2.5.7. [lt_timeline_filter.php](#view_lt_timeline_filter)
		- 3.2.6. [Template](#view_template)
			- 3.2.6.1. [lt_header.php](#view_lt_header)
			- 3.2.6.2. [lt_menu.php](#view_lt_menu)
			- 3.2.6.3. [lt_footer.php](#view_lt_footer)
	- 3.3. [Controller](#lt_controllers)
		- 3.3.1. [Lt_index.php](#lt_index)
		- 3.3.2. [Lt_uploader.php](#lt_uploader)
		- 3.3.3. [Lt_timeline_generator.php](#lt_timeline_generator)
	- 3.4. [Libraries](#lt_libraries)
		- 3.4.1. [MY_LT_LIB.php](#MY_LT_LIB)



## 1.<a id="lt_introducao">Introdução</a>
*****************************************

Lattes Timeline é uma aplicação Web para visualização de currículos da plataforma Lattes do CNPQ, em formato XML.
É possível visualizar as publicações do currículo em um formato de linha do tempo, todas organizadas por ano e tipos.
Também pode-se visualizar um gráfico interativo com a quantidade de publicações por ano.


## 1.1.<a id="lt_finalidade">Finalidade</a>

Este documento apresenta uma visão geral abrangente da arquitetura do sistema e utiliza uma série de visões arquiteturais diferentes para ilustrar os diversos aspectos do sistema. Sua intenção é capturar e transmitir as decisões significativas do ponto de vista da arquitetura que foram tomadas em relação ao sistema.


## 1.2.<a id="lt_vocabulario">Vocabulário</a>

| C.I.						= CodeIgniter;<br>
| NODES						= Nós ou Tags de um arquivo XML;<br>
| Timeline 					= Linha do tempo;


## 1.3.<a id="lt_versao">Informações de Versão</a>

Repositório do código de desenvolvimento. Para baixar a última versão,
acesse o link [Lattes Timeline](https://bitbucket.org/GShiki/lattes-timeline).


## 1.4.<a id="lt_requerimentos">Requerimentos de Servidor</a>

[PHP versão 5.4](https://www.php.net/) (recomendado) ou versão mais nova.


## 1.5.<a id="lt_instalacao">Instalação</a>

Para entender melhor o processo de instalação, veja como instalar o framework em PHP CodeIgniter no 
seguinte link : [Guia de Instalação CodeIgniter](http://www.codeigniter.com/user_guide/installation/index.html).


## 1.6.<a id="lt_licenca">Licença</a>

Necessário ler também a licença do arquivo license.txt dentro desse projeto.

O software se utiliza da licença GPL - General Public License - visa garantir quatro liberdades básicas ao usuário desse programa :

1. A liberdade de executar o programa, para qualquer propósito
2. A liberdade de estudar como o programa funciona e adaptá-lo para as suas necessidades
3. A liberdade de redistribuir cópias de modo que você possa ajudar ao seu próximo
4. A liberdade de aperfeiçoar o programa, e liberar os seus aperfeiçoamentos, de modo que toda a comunidade se beneficie deles


## 1.7.<a id="lt_recursos">Recursos</a>

-  [Guia do Usuário do CodeIgniter](http://www.codeigniter.com/docs)
-  [Forums do CodeIgniter](http://forum.codeigniter.com/)
-  [Wiki do CodeIgniter](https://github.com/bcit-ci/CodeIgniter/wiki)
-  [Comunidade IRC do CodeIgniter](http://www.codeigniter.com/irc)
-  [JQuery API](http://api.jquery.com/)
-  


## 2. <a id="lt_visao_casos_uso">Visão de Casos de Uso</a>
************************

## 2.1. <a id="lt_visualizar_timeline_curriculo">Visualizar Timeline de Currículo</a>

	- Atores :
		- Usuário Comum
		- Sistema

	- Precondições :
		- N/A

	- Fluxo Básico :
		- Usuário clica no botão de ícone azul para <i>Upload</i>;
		- O Sistema abre uma tela de escolha de arquivos;
		- Usuário escolhe um arquivo de currículo apenas no formato de XML;
		- Usuário clica no botão azul escrito "Gerar Timeline";
		- O Sistema mostra uma página com a linha de tempo de produções acadêmicas do currículo;

	- Fluxo(s) Alternativo(s) : 
		- N/A

## 2.2. <a id="lt_visualizar_grafico_publicacoes_curriculo">Visualizar Gráfico de Publicações de Currículo</a>

	- Atores :
		- Usuário Comum
		- Sistema

	- Precondições :
		- Usuário estar na página de linha do tempo de um currículo;

	- Fluxo Básico :
		- Usuário clica no ícone de um gráfico localizado no canto direito ao nome do pesquisador do currículo escolhido;
		- Sistema abre um modal com o gráfico contendo os anos de publicação do pesquisador do currículo escolhido;

	- Fluxo(s) Alternativo(s) :
		- N/A


## 3. <a id="lt_visao_logica">Visão Lógica</a>
**********************************************

A aplicação utiliza a arquitetura básica de MVC já existente no framework CodeIgniter. Abaixo são descritos em detalhes o funcionamento das <i>Views</i> e dos <i>Controllers</i>.


## 3.1. <a id="lt_model">Model</a>

Não há implementação de modelo na aplicação.


## 3.2. <a id="lt_view">View</a>

Arquivos que implementam as views da aplicação (páginas da aplicação).

- 3.2.1. <a id="view_lt_index">lt_index</a>

>  View que representa a página inicial. Visualização 
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



