/*
 * LT_TIMELINE
 * ---------------------------------------
 * DESCRICAO : Javascript que contem as 
 * funcoes de todo o Timeline.
 * ---------------------------------------
*/
/* ********************************** CHAMADAS ********************************** */
$(document).ready( function(){
	initTimelineContent();
	// INIT DOS ELEMENTOS PRINCIPAIS
	initToggleProjects();
	initToggleProductions();
	initToggleBoards();
	initToggleOrientations();
});

/* *********************************** FUNCOES ********************************** */
function initTimelineContent() {
	var $elementContainerYears = $('#lt-container-years');
	var $elementContainerContent = $('#lt-container-timeline-content');
	if ($elementContainerYears.length && $elementContainerContent.length) {
		var higherHeight = Math.max($elementContainerYears.height(), $elementContainerContent.height());
		if (higherHeight > $elementContainerContent.height()) {
			$elementContainerContent.height(higherHeight);
		}
	}
}

function initToggleProjects() {
	var $elementsToggleProjects = $('div[data-node="lt-container-year-content-projects"]');
	if ($elementsToggleProjects.length) {
		for (var indexProjects = $elementsToggleProjects.length - 1; indexProjects >= 0; indexProjects--) {
			var $elementToggleProject = $($elementsToggleProjects[indexProjects]);
			if ($elementToggleProject.length) {
				var $elementToggleProjectTitle = $($elementToggleProject.children('.lt-container-year-academic-node-title')[0]);
				if ($elementToggleProjectTitle.length) {
					$elementToggleProjectTitle.click( { elementProjectClicked : $elementToggleProject }, toggleProject );
				}
			}
		}
	}
}

function initToggleProductions() {
	var $elementsToggleProductions = $('div[data-node="lt-container-year-content-productions"]');
	if ($elementsToggleProductions.length) {
		for (var indexProductions = $elementsToggleProductions.length - 1; indexProductions >= 0; indexProductions--) {
			var $elementToggleProduction = $($elementsToggleProductions[indexProductions]);
			if ($elementToggleProduction.length) {
				var $elementToggleProductionTitle = $($elementToggleProduction.children('.lt-container-year-academic-node-title')[0]);
				if ($elementToggleProductionTitle.length) {
					$elementToggleProductionTitle.click( { elementProductionClicked : $elementToggleProduction }, toggleProduction );
				}
			}
		}
	}
}

function initToggleBoards() {
	var $elementsToggleBoards = $('div[data-node="lt-container-year-content-boards"]');
	if ($elementsToggleBoards.length) {
		for (var indexBoards = $elementsToggleBoards.length - 1; indexBoards >= 0; indexBoards--) {
			var $elementToggleBoard = $($elementsToggleBoards[indexBoards]);
			if ($elementToggleBoard.length) {
				var $elementToggleBoardTitle = $($elementToggleBoard.children('.lt-container-year-academic-node-title')[0]);
				if ($elementToggleBoardTitle.length) {
					$elementToggleBoardTitle.click( { elementBoardClicked : $elementToggleBoard }, toggleBoard );
				}
			}
		}
	}
}

function initToggleOrientations() {
	var $elementsToggleOrientations = $('div[data-node="lt-container-year-content-orientations"]');
	if ($elementsToggleOrientations.length) {
		for (var indexOrientations = $elementsToggleOrientations.length - 1; indexOrientations >= 0; indexOrientations--) {
			var $elementToggleOrientation = $($elementsToggleOrientations[indexOrientations]);
			if ($elementToggleOrientation.length) {
				var $elementToggleOrientationTitle = $($elementToggleOrientation.children('.lt-container-year-academic-node-title')[0]);
				if ($elementToggleOrientationTitle.length) {
					$elementToggleOrientationTitle.click( { elementOrientationClicked : $elementToggleOrientation }, toggleOrientation );
				}
			}
		}
	}
}

/* ******************** FUNCOES DOS NODES PRINCIPAIS DE CADA ANO ******************** */
function toggleProject(event) {
	var $elementProjectToToggle = $(event.data.elementProjectClicked);
	if ($elementProjectToToggle.length) {
		var $elementProjectTitleToToggle = $($elementProjectToToggle.children('.lt-container-year-academic-node-title')[0]);
		var $elementProjectContentToToggle = $($elementProjectToToggle.children('.lt-container-year-academic-node-content')[0]);
		if ($elementProjectTitleToToggle.length && $elementProjectContentToToggle.length) {
			var $elementProjectTitleMinimizer = $($elementProjectTitleToToggle.children('span#lt-node-minimizer')[0]);

			if ($elementProjectTitleMinimizer.length) {
				if (!$elementProjectTitleToToggle.hasClass('lt-minor-title')) {
					$elementProjectTitleToToggle.addClass('lt-minor-title');
				} else {
					$elementProjectTitleToToggle.removeClass('lt-minor-title');
				}
				if ( $elementProjectTitleMinimizer.html().indexOf('-') > -1 ) {
					$elementProjectTitleMinimizer.html('+');
				} else {
					$elementProjectTitleMinimizer.html('-');
				}
				$elementProjectContentToToggle.slideToggle(EFFECT_TIME_SLIDE_ACADEMIC_NODE);
			}
		}
	}
}

function toggleProduction(event) {
	var $elementProdToToggle = $(event.data.elementProductionClicked);
	if ($elementProdToToggle.length) {
		var $elementProdTitleToToggle = $($elementProdToToggle.children('.lt-container-year-academic-node-title')[0]);
		var $elementProdContentToToggle = $($elementProdToToggle.children('.lt-container-year-academic-node-content')[0]);
		if ($elementProdTitleToToggle.length && $elementProdContentToToggle.length) {
			var $elementProdTitleMinimizer = $($elementProdTitleToToggle.children('span#lt-node-minimizer')[0]);

			if ($elementProdTitleMinimizer.length) {
				if (!$elementProdTitleToToggle.hasClass('lt-minor-title')) {
					$elementProdTitleToToggle.addClass('lt-minor-title');
				} else {
					$elementProdTitleToToggle.removeClass('lt-minor-title');
				}
				if ( $elementProdTitleMinimizer.html().indexOf('-') > -1 ) {
					$elementProdTitleMinimizer.html('+');
				} else {
					$elementProdTitleMinimizer.html('-');
				}
				$elementProdContentToToggle.slideToggle(EFFECT_TIME_SLIDE_ACADEMIC_NODE);
			}
		}
	}
}

function toggleBoard(event) {
	var $elementBoardToToggle = $(event.data.elementBoardClicked);
	if ($elementBoardToToggle.length) {
		var $elementBoardTitleToToggle = $($elementBoardToToggle.children('.lt-container-year-academic-node-title')[0]);
		var $elementBoardContentToToggle = $($elementBoardToToggle.children('.lt-container-year-academic-node-content')[0]);
		if ($elementBoardTitleToToggle.length && $elementBoardContentToToggle.length) {
			var $elementBoardTitleMinimizer = $($elementBoardTitleToToggle.children('span#lt-node-minimizer')[0]);

			if ($elementBoardTitleMinimizer.length) {
				if (!$elementBoardTitleToToggle.hasClass('lt-minor-title')) {
					$elementBoardTitleToToggle.addClass('lt-minor-title');
				} else {
					$elementBoardTitleToToggle.removeClass('lt-minor-title');
				}
				if ( $elementBoardTitleMinimizer.html().indexOf('-') > -1 ) {
					$elementBoardTitleMinimizer.html('+');
				} else {
					$elementBoardTitleMinimizer.html('-');
				}
				$elementBoardContentToToggle.slideToggle(EFFECT_TIME_SLIDE_ACADEMIC_NODE);
			}
		}
	}
}

function toggleOrientation(event) {
	var $elementOrientationToToggle = $(event.data.elementOrientationClicked);
	if ($elementOrientationToToggle.length) {
		var $elementOrientationTitleToToggle = $($elementOrientationToToggle.children('.lt-container-year-academic-node-title')[0]);
		var $elementOrientationContentToToggle = $($elementOrientationToToggle.children('.lt-container-year-academic-node-content')[0]);
		if ($elementOrientationTitleToToggle.length && $elementOrientationContentToToggle.length) {
			var $elementOrientationTitleMinimizer = $($elementOrientationTitleToToggle.children('span#lt-node-minimizer')[0]);

			if ($elementOrientationTitleMinimizer.length) {
				if (!$elementOrientationTitleToToggle.hasClass('lt-minor-title')) {
					$elementOrientationTitleToToggle.addClass('lt-minor-title');
				} else {
					$elementOrientationTitleToToggle.removeClass('lt-minor-title');
				}
				if ( $elementOrientationTitleMinimizer.html().indexOf('-') > -1 ) {
					$elementOrientationTitleMinimizer.html('+');
				} else {
					$elementOrientationTitleMinimizer.html('-');
				}
				$elementOrientationContentToToggle.slideToggle(EFFECT_TIME_SLIDE_ACADEMIC_NODE);
			}
		}
	}
}
