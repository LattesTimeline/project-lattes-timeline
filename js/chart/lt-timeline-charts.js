/*
 * LT_TIMELINE_CHARTS
 * ---------------------------------------
 * DESCRICAO : Javascript responsavel pela
 * construcao e manipulacao do grafico, do 
 * modal e da mascara do modal.
 * ---------------------------------------
*/
/* ********************************** GLOBAIS *********************************** */
var BarChart;

/* ********************************** CHAMADAS ********************************** */
$(document).ready( function(){
	initChartElements();
});

/* *********************************** FUNCOES ********************************** */
function initChartElements() {
	var $elementModalMask = $('#lt-modal-mask');
	var $elementChartImage = $('#lt-image-charts');
	var $elementsChartFilterYears = $('input[name*="lt-chart-filter-year-"]');
	// INICIALIZA A IMAGEM QUE CHAMA A FUNCAO DO GRAFICO
	if ($elementChartImage.length && $elementModalMask.length) {
		$elementModalMask.click( closeModalChart );
		$elementChartImage.click( showChart );
	}
	// INICIALIZA OS INPUTS QUE SAO O FILTRO DE ANOS DO GRAFICO
	if ($elementsChartFilterYears.length) {
		for (var indexYears = $elementsChartFilterYears.length - 1; indexYears >= 0; indexYears--) {
			var $elementChartFilterYear = $($elementsChartFilterYears[indexYears]);
			if ($elementChartFilterYear.length) {
				$elementChartFilterYear.change( updateChart );
			}
		}
	}
}

function openModalChart() {
	var $elementModalChart = $('#lt-modal-chart');
	if ($elementModalChart.length) {
		$elementModalChart.show(EFFECT_TIME_SHOW_MODAL, function() {
			$elementModalChart.css({
				maxHeight : screen.height - ( screen.height * 5/100 )
			});
			showModalMask();
		});
	}
}

function closeModalChart() {
	var $elementModalChart = $('#lt-modal-chart');
	if ($elementModalChart.length) {
		$elementModalChart.hide(EFFECT_TIME_HIDE_MODAL, function() {
			if (BarChart) {
				BarChart.destroy();
			}
			hideModalMask();
		});
	}
}

function showModalMask() {
	var $elementWindow = $(window);
	var $elementDocument = $(document);
	var $elementModalMask = $('#lt-modal-mask');
	if ($elementModalMask.length && $elementWindow.length && $elementDocument.length) {
		var maxWidth = Math.max( $elementWindow.width(), $elementDocument.width() );
		var maxHeight = Math.max( $elementWindow.height(), $elementDocument.height() );
		if (maxWidth && maxHeight) {
			$elementModalMask.css({
				display : 'block',
				width : maxWidth,
				height : maxHeight
			});
		}
	}
}

function hideModalMask() {
	var $elementModalMask = $('#lt-modal-mask');
	if ($elementModalMask.length) {
		$elementModalMask.css({
			display : 'none',
			width : 0,
			height : 0
		});
	}
}

function showChart() {
	openModalChart();

	buildChart();
}

function buildChart() {
	var $elementCanvas = $('#lt-chart');
	var $elementModalChart = $('#lt-modal-chart');
	var $elementHiddenYear = $('input[name="chart-years[]"]');
	if ($elementCanvas.length && $elementModalChart.length) {
		var ctx = document.getElementById('lt-chart').getContext('2d');
		var years = $elementHiddenYear.map( function() { return $(this).val(); } ).get();
		
		var options = {
			scaleShowGridLines : true,
			scaleGridLineColor : 'rgba(0, 0, 0, 0.1)',
		    barShowStroke : true,
		    barStrokeWidth : 2,
		    barValueSpacing : 5,
		    barDatasetSpacing : 2
		};

		$elementCanvas.css({
			width : screen.width * MODIFIER_MODAL_CHART_WIDTH,
			height : screen.height * MODIFIER_MODAL_CHART_HEIGHT
		});

	    BarChart = new Chart(ctx).Bar(getChartData(years), options);
	}
}

function updateChart() {
	if (BarChart) {
		BarChart.destroy();
	}
	buildChart();
}

/* *********************** FUNCOES DE INTERFACE DO GRAFICO ********************** */
function getProjectsUI(arrayProjects) {
	return {
		label: 'Projetos',
        fillColor: BAR_COLOR_PROJECTS,
        strokeColor: 'rgba(50, 50, 50, 0.8)',
        highlightFill: BAR_COLOR_HIGHLIGHTED_PROJECTS,
        highlightStroke: 'rgba(220, 220, 220, 1)',
        data: arrayProjects
	};
}

function getProductionsUI(arrayProductions) {
	return {
		label: 'Produções',
        fillColor: BAR_COLOR_PRODUCTIONS,
        strokeColor: 'rgba(50, 50, 50, 0.8)',
        highlightFill: BAR_COLOR_HIGHLIGHTED_PRODUCTIONS,
        highlightStroke: 'rgba(151, 187, 205, 1)',
        data: arrayProductions
	};
}

function getBoardsUI(arrayBoards) {
	return {
		label: 'Bancas',
        fillColor: BAR_COLOR_BOARDS,
        strokeColor: 'rgba(50, 50, 50, 0.8)',
        highlightFill: BAR_COLOR_HIGHLIGHTED_BOARDS,
        highlightStroke: 'rgba(120, 120, 120, 1)',
        data: arrayBoards
	};
}

function getOrientationsUI(arrayOrientations) {
	return {
		label: 'Orientações',
        fillColor: BAR_COLOR_ORIENTATIONS,
        strokeColor: 'rgba(50, 50, 50, 0.8)',
        highlightFill: BAR_COLOR_HIGHLIGHTED_ORIENTATIONS,
        highlightStroke: 'rgba(50, 108, 153, 1)',
        data: arrayOrientations
	};
}

Chart.defaults.global.customTooltips = function(tooltip) {
	var tooltipContent = '';
	var event = event || window.event;
	var $elementToolTip = $('#lt-chart-tooltip');
	
	//console.log(tooltip);

	if (!tooltip) {
		$elementToolTip.hide(EFFECT_TIME_HIDE_TOOLTIP);
		return;
	}


	tooltipContent += '<div class="lt-tooltip-title">';
	tooltipContent += tooltip.title;
	tooltipContent += '</div>';

	tooltipContent += '<div class="lt-tooltip-container-list">'
	tooltipContent += '<ul class="lt-tooltip-list">';
	// PROJETOS
	tooltipContent += '<li>';
	tooltipContent += 'Projetos de Pesquisa : ';
	tooltipContent += tooltip.labels[0];
	tooltipContent += '</li>';
	// PRODUCOES
	tooltipContent += '<li>';
	tooltipContent += 'Produções : ';
	tooltipContent += tooltip.labels[1];
	tooltipContent += '</li>';
	// BANCAS
	tooltipContent += '<li>';
	tooltipContent += 'Bancas : ';
	tooltipContent += tooltip.labels[2];
	tooltipContent += '</li>';
	// ORIENTACAO
	tooltipContent += '<li>';
	tooltipContent += 'Orientações : ';
	tooltipContent += tooltip.labels[3];
	tooltipContent += '</li>';

	tooltipContent += '</ul>';
	tooltipContent += '</div>';

	$elementToolTip.html(tooltipContent);

	$elementToolTip.css({
		/*( tooltip.y + tooltip.yPadding )*/
		top : ( event.clientY + tooltip.yPadding * 2 ) + 'px',
		/*( tooltip.x + tooltip.xPadding )*/
		left : ( event.clientX + tooltip.xPadding * 2 )  + 'px',
		fontFamily : tooltip.fontFamily,
		fontSize : tooltip.fontSize,
		fontStyle : tooltip.fontStyle,
	});
	$elementToolTip.show(EFFECT_TIME_SHOW_TOOLTIP);
}

/* ************************* FUNCOES DE DADOS DO GRAFICO ************************ */
function getChartData(arrayYears) {
	var dataYears = [];
	var projects = [];
	var productions = [];
	var boards = [];
	var orientations = [];
	// CONTA PARA CADA UM DOS ANOS
	for (var indexYear = 0; indexYear < arrayYears.length; indexYear++) {
		var $elementChartFiltY = $('input[name="lt-chart-filter-year-' + arrayYears[indexYear] + '"]');
		if ($elementChartFiltY.length && $elementChartFiltY.is(':checked')) {
			dataYears.push(arrayYears[indexYear]);
			projects.push( countProjects(arrayYears[indexYear]) );			
			productions.push( countProductions(arrayYears[indexYear]) );
			boards.push( countBoards(arrayYears[indexYear]) );
			orientations.push( countOrientations(arrayYears[indexYear]) );
		}
	}
	var data = {
		labels : dataYears,

		datasets : [ 
					 getProjectsUI(projects), 
					 getProductionsUI(productions),
					 getBoardsUI(boards),
					 getOrientationsUI(orientations)
				   ]
	};
	return data;
}

function countProjects(yearToProjects) {
	var $elementYearProjects = $('input[name="chart-' + yearToProjects + '-projects"]');
	var $elementInputProjects = $('input[name="lt-container-year-content-projects"]');
	if ($elementYearProjects.length && $elementInputProjects.length) {
		if ($elementInputProjects.is(':checked')) {
			return parseInt($elementYearProjects.val());
		}
	}
	return 0;
}

function countProductions(yearToProductions) {
	var counterProductions = 0;
	var $elementYearProdBooks = $('input[name="chart-' + yearToProductions + '-prod-books"]');
	var $elementYearProdChapters = $('input[name="chart-' + yearToProductions + '-prod-chapters"]');
	var $elementYearProdOthers = $('input[name="chart-' + yearToProductions + '-prod-other"]');
	var $elementYearProdEvents = $('input[name="chart-' + yearToProductions + '-prod-events"]');
	var $elementYearProdTechnicals = $('input[name="chart-' + yearToProductions + '-prod-technical"]');
	var $elementInputProductions = $('input[name="lt-container-year-content-productions"]');
	// LIVROS
	if ($elementYearProdBooks.length && $elementInputProductions.length) {
		if ($elementInputProductions.is(':checked')) {
			counterProductions += parseInt($elementYearProdBooks.val());
		}
	}
	// CAPITULOS
	if ($elementYearProdChapters.length && $elementInputProductions.length) {
		if ($elementInputProductions.is(':checked')) {
			counterProductions += parseInt($elementYearProdChapters.val());
		}
	}
	// OUTRA PRODUCOES
	if ($elementYearProdOthers.length && $elementInputProductions.length) {
		if ($elementInputProductions.is(':checked')) {
			counterProductions += parseInt($elementYearProdOthers.val());
		}
	}
	// PRODUCOES EM EVENTOS
	if ($elementYearProdEvents.length && $elementInputProductions.length) {
		if ($elementInputProductions.is(':checked')) {
			counterProductions += parseInt($elementYearProdEvents.val());
		}
	}
	// PRODUCOES TECNICAS
	if ($elementYearProdTechnicals.length && $elementInputProductions.length) {
		if ($elementInputProductions.is(':checked')) {
			counterProductions += parseInt($elementYearProdTechnicals.val());
		}
	}
	return counterProductions;
}

function countBoards(yearToBoards) {
	var counterBoards = 0;
	var $elementYearMasterBoards = $('input[name="chart-' + yearToBoards + '-master-boards"]');
	var $elementYearQualiBoards = $('input[name="chart-' + yearToBoards + '-quali-boards"]');
	var $elementYearExpertBoards = $('input[name="chart-' + yearToBoards + '-expert-boards"]');
	var $elementYearGraduatBoards = $('input[name="chart-' + yearToBoards + '-graduat-boards"]');
	var $elementInputBoards = $('input[name="lt-container-year-content-boards"]');
	// BANCA DE MESTRADO
	if ($elementYearMasterBoards.length && $elementInputBoards.length) {
		if ($elementInputBoards.is(':checked')) {
			counterBoards += parseInt($elementYearMasterBoards.val());
		}
	}
	// BANCA DE QUALIFICACAO
	if ($elementYearQualiBoards.length && $elementInputBoards.length) {
		if ($elementInputBoards.is(':checked')) {
			counterBoards += parseInt($elementYearQualiBoards.val());
		}
	}
	// BANCA DE ESPECIALIZACAO
	if ($elementYearExpertBoards.length && $elementInputBoards.length) {
		if ($elementInputBoards.is(':checked')) {
			counterBoards += parseInt($elementYearExpertBoards.val());
		}
	}
	// BANCA DE GRADUACAO
	if ($elementYearGraduatBoards.length && $elementInputBoards.length) {
		if ($elementInputBoards.is(':checked')) {
			counterBoards += parseInt($elementYearGraduatBoards.val());
		}
	}
	return counterBoards;
}

function countOrientations(yearToOrientations) {
	var counterOrientations = 0;
	var $elementYearDoneMasterOrient = $('input[name="chart-' + yearToOrientations + '-done-master-orientations"]');
	var $elementYearDoneOtherOrient = $('input[name="chart-' + yearToOrientations + '-done-other-orientations"]');
	var $elementYearGoingScientOrient = $('input[name="chart-' + yearToOrientations + '-going-scient-orientations"]');
	var $elementYearGoingMasterOrient = $('input[name="chart-' + yearToOrientations + '-going-master-orientations"]');
	var $elementInputOrientations = $('input[name="lt-container-year-content-orientations"]');
	// ORIENTACOES CONCLUIDAS DE MESTRADO
	if ($elementYearDoneMasterOrient.length && $elementInputOrientations.length) {
		if ($elementInputOrientations.is(':checked')) {
			counterOrientations += parseInt($elementYearDoneMasterOrient.val());
		}
	}
	// OUTRAS ORIENTACOES CONCLUIDAS
	if ($elementYearDoneOtherOrient.length && $elementInputOrientations.length) {
		if ($elementInputOrientations.is(':checked')) {
			counterOrientations += parseInt($elementYearDoneOtherOrient.val());
		}
	}
	// ORIENTACOES CIENTIFICAS EM ANDAMENTO
	if ($elementYearGoingScientOrient.length && $elementInputOrientations.length) {
		if ($elementInputOrientations.is(':checked')) {
			counterOrientations += parseInt($elementYearGoingScientOrient.val());
		}
	}
	// ORIENTACOES DE MESTRADO EM ANDAMENTO
	if ($elementYearGoingMasterOrient.length && $elementInputOrientations.length) {
		if ($elementInputOrientations.is(':checked')) {
			counterOrientations += parseInt($elementYearGoingMasterOrient.val());
		}
	}
	return counterOrientations;
}
