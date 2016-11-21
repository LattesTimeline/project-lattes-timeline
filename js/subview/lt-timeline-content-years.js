/*
 * LT_TIMELINE_CONTENT_YEARS
 * ---------------------------------------
 * DESCRICAO : Javascript que contem as 
 * funcoes do menu lateral de anos.
 * ---------------------------------------
*/
/* ********************************** CHAMADAS ********************************** */
$(document).ready( function(){
	initTopButton();
	initTimelineYears();
});

/* *********************************** FUNCOES ********************************** */
function initTopButton() {
	var $elementTopButton = $('#lt-container-top-button');
	if ($elementTopButton.length) {
		$(window).scroll( function() {
			testTopButtonVisibility();
		});
		$elementTopButton.click( function(event) {
			event.preventDefault();

			$('html:not(:animated),body:not(:animated)').animate( { 
				scrollTop: $('#lt-container-top-button-visibility').offset().top - 50
			}, EFFECT_TIME_SCROLL_TOP);
		});
	}
}

function initTimelineYears() {
	var $elementsYears = $('[id*="lt-container-timeline-year"]');
	if ($elementsYears.length) {
		for (var indexYears = $elementsYears.length - 1; indexYears >= 0; indexYears--) {
			var $elementYearContent = $($elementsYears[indexYears]);
			if ($elementYearContent.length) {
				$elementYearContent.click( { paramClickedYear : $elementYearContent }, toggleYearContent);
			}
		}
	}
}

/* ******************** FUNCOES DO LINK DE CADA ANO ******************** */
function toggleYearContent(event) {
	var $elementClickedYear = $(event.data.paramClickedYear);
	if ($elementClickedYear.length) {
		var year = parseInt(REGEX_ONLY_NUMBERS.exec($elementClickedYear.attr('id')));
		var $elementContainerYearContent = $('#' + year);
		if ($elementContainerYearContent.length) {
			var $elementYearAcademicContent = $('#' + year + ' > div#lt-container-timeline-academic-content');
			if ($elementYearAcademicContent.length) {
				if ($elementYearAcademicContent.is(':visible')) {
					lowlightYearLink(year);
				} else {
					highlightYearLink(year);
				}
				$elementYearAcademicContent.slideToggle(EFFECT_TIME_SLIDE_YEAR_NODE);
			}
		}
	}
}

function lowlightYearLink(year) {
	var $elementYearLink = $('a[href="#' + year +'"]');
	if ($elementYearLink.length) {
		$elementYearLink.addClass('lt-hidden-year');
	}
}

function highlightYearLink(year) {
	var $elementYearLink = $('a[href="#' + year +'"]');
	if ($elementYearLink.length) {
		$elementYearLink.removeClass('lt-hidden-year');
	}
}

/* ******************** FUNCOES DO BOTAO TOPO ******************** */
function testTopButtonVisibility() {
	var $elementTopButtonVisibility = $('#lt-container-top-button-visibility');
	if ($elementTopButtonVisibility.length) {
		if (isVisibleOnScreen($elementTopButtonVisibility)) {
			hideTopButton();
		} else {
			showTopButton();
		}
	}
}

function showTopButton() {
	var $elementTopButton = $('#lt-container-top-button');
	if ($elementTopButton.length) {
		$elementTopButton.show();
	}
}

function hideTopButton() {
	var $elementTopButton = $('#lt-container-top-button');
	if ($elementTopButton.length) {
		$elementTopButton.hide();
	}
}
