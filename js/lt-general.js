/*
 * LT_GENERAL
 * ---------------------------------------
 * DESCRICAO : Javascript que contem as 
 * funcoes gerais da aplicacao.
 * ---------------------------------------
*/
/* ********************************** CHAMADAS ********************************** */
$(document).ready( function(){
	initImageUpload();
	initInputUpload();
});

/* *********************************** FUNCOES ********************************** */
function initImageUpload() {
	var $elementImageUpload = $('#lt-image-upload');
	if ($elementImageUpload.length) {
		$elementImageUpload.click( clickInput );
	}
}

function initInputUpload() {
	var $elementInputUpload = $('#lt-input-upload');
	if ($elementInputUpload.length) {
		$elementInputUpload.change( loadFileName );
	}
}

function clickInput() {
	var $elementInputUpload = $('#lt-input-upload');
	if ($elementInputUpload.length) {
		$elementInputUpload.click();
	}
}

function loadFileName() {
	var $elementInputUpload = $('#lt-input-upload');
	if ($elementInputUpload.length) {
		var $elementFileName = $('#lt-file-name-upload div span');
		var $elementContainerFileName = $('#lt-file-name-upload');
		if ($elementFileName.length && $elementContainerFileName.length) {
			var tempFileName = processFakePath($elementInputUpload.val());
			$elementContainerFileName.show();
			$elementFileName.html(tempFileName);
		}
	}
}

function isVisibleOnScreen(element) {
	var $element = $(element);
    var $window = $(window);

    var windowTopView = $window.scrollTop();
    var windowBottomView = windowTopView + $window.height();

    var elementTopView = $element.offset().top;
    var elementBottomView = elementTopView + $element.height();

    return ( (elementBottomView <= windowBottomView) && (elementTopView >= windowTopView) );
}

function processFakePath(path) {
	var indexFakePath = path.indexOf('fakepath');
	if (indexFakePath > -1) {
		var indexPath = indexFakePath + 'fakepath'.length + 1;
		return path.substring(indexPath);
	}
	return path;
}
