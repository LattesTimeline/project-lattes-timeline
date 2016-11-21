<div id="lt-container-years-links" class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	<div id="lt-container-top-button-visibility"></div>
	<?php foreach ($curriculum['years'] as $year) { ?>
	<div class="lt-container-year row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a class="lt-hidden-year" href="#<?php echo $year; ?>"><?php echo $year; ?></a>
		</div>
	</div>
	<?php } ?>
	<div id="lt-container-top-button">
		<span><?php echo lang('lt_label_top'); ?></span>
	</div>
</div>