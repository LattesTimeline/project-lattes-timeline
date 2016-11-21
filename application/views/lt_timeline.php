<div class="lt-container-main col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="lt-container-name row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<span><?php echo $curriculum['name']; ?></span>

			<img id="lt-image-charts" 
			 alt="<?php echo lang('lt_alt_image_charts'); ?>" 
			 title="<?php echo lang('lt_title_image_charts'); ?>"
			 class="pull-right img-responsive" 
			 src="<?php echo base_url(); ?>images/img-bar-chart.png" />
		</div>
		<hr class="lt-separator"/>
	</div>

	<?php $this->load->view('subview/lt_timeline_filter'); ?>

	<hr class="lt-separator"/>

	<?php $this->load->view('subview/lt_timeline_content'); ?>
</div>