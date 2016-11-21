/*
 * LT_TIMELINE_FILTER
 * ---------------------------------------
 * DESCRICAO : Javascript que contem as 
 * funcoes do menu do topo de filtros.
 * ---------------------------------------
*/
/* ********************************** CHAMADAS ********************************** */
$(document).ready( function(){
	initMinimizerElements();
	initFilterElements();
});

/* *********************************** FUNCOES ********************************** */
function initMinimizerElements() {
	var $elementImagePlus = $('#lt-image-plus');
	var $elementImageMinus = $('#lt-image-minus');
	if ($elementImagePlus.length && $elementImageMinus.length) {
		$elementImagePlus.click( showFilters );
		$elementImageMinus.click( hideFilters );
	}
}

function initFilterElements() {
	var $elementContainerFilters = $('#lt-container-filters');
	if ($elementContainerFilters.length) {
		var $elementsInputFilters = $elementContainerFilters.find('input[type="checkbox"]');
		if ($elementsInputFilters.length) {
			for (var indexFilter = $elementsInputFilters.length - 1; indexFilter >= 0; indexFilter--) {
				$elementInputFilter = $($elementsInputFilters[indexFilter]);
				if ($elementInputFilter.length) {
					$elementInputFilter.change( { elementInputFilterClicked : $elementInputFilter }, toggleFilterContainer );
				}
			}
		}
	}
}

/* ******************** FUNCOES DO MENU DE FILTRO ******************** */
function hideFilters() {
	var $elementImagePlus = $('#lt-image-plus');
	var $elementImageMinus = $('#lt-image-minus');
	var $elementContainerFilters = $('#lt-container-filters');
	if ($elementImagePlus.length && $elementImageMinus.length && $elementContainerFilters.length) {
		$elementImageMinus.addClass('lt-hidden');
		$elementImagePlus.removeClass('lt-hidden');

		$elementContainerFilters.slideToggle('slow');
	}
}

function showFilters() {
	var $elementImagePlus = $('#lt-image-plus');
	var $elementImageMinus = $('#lt-image-minus');
	var $elementContainerFilters = $('#lt-container-filters');
	if ($elementImagePlus.length && $elementImageMinus.length && $elementContainerFilters.length) {
		$elementImagePlus.addClass('lt-hidden');
		$elementImageMinus.removeClass('lt-hidden');

		$elementContainerFilters.slideToggle('slow');
	}
}

function toggleFilterContainer(event) {
	var $elementInputFilterToToggle = $(event.data.elementInputFilterClicked);
	if ($elementInputFilterToToggle.length) {
		var $elementsContainersToToggle = $('div[data-node="' + $elementInputFilterToToggle.val() + '"]');
		if ($elementsContainersToToggle.length) {
			for (var indexContainer = $elementsContainersToToggle.length - 1; indexContainer >= 0; indexContainer--) {
				var $elementContainerToToggle = $($elementsContainersToToggle[indexContainer]);
				if ($elementInputFilterToToggle.is(':checked')) {
					$elementContainerToToggle.show(EFFECT_TIME_TOGGLE_ACADEMIC_NODE);
				} else {
					$elementContainerToToggle.hide(EFFECT_TIME_TOGGLE_ACADEMIC_NODE);
				}
			}
		}
	}
}
