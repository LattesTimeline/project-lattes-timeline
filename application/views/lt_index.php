<div class="lt-container-main col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="lt-container-welcome lt-container-text-center">
		<span>
			<?php echo lang('lt_message_welcome'); ?>
		</span>
	</div>
	<div class="lt-container-text-center">
		<span>
			<?php echo lang('lt_message_upload'); ?>
		</span>
		<br>
		<br>
		<span>
			<?php echo lang('lt_message_xml'); ?>
		</span>
	</div>
	<div class="lt-container-text-center lt-container-upload">
		<form action="<?php echo base_url(); ?>uploader" enctype="multipart/form-data" method="POST">
			<input id="lt-input-upload" type="file" name="lt-param-xml-file"/>
			<?php if ( !empty($this->session->flashdata('missing_file')) ) { ?>
                <div class="row">
					<div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 
								col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="lt-container-error">
							<span><?php echo $this->session->flashdata('missing_file'); ?></span>
						</div>
					</div>
				</div>
            <?php } ?>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<img id="lt-image-upload" 
					 alt="<?php echo lang('lt_alt_image_upload'); ?>" 
					 title="<?php echo lang('lt_title_image_upload'); ?>" 
					 src="<?php echo base_url(); ?>images/img-upload.png"/>
				</div>
			</div>
			<div id="lt-file-name-upload" class="row">
				<div class="lt-container-text-filename lt-container-text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span><?php echo $this->session->flashdata('file_name'); ?></span>
				</div>
			</div>
			<div class="row">
				<div class="lt-container-button col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<input class="lt-button" type="submit" name="lt-param-act-upload" 
					 value="<?php echo lang('lt_label_generate_timeline'); ?>"/>
				</div>
			</div>
		</form>
	</div>
</div>