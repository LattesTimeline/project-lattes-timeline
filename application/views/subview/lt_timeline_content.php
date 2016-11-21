<div class="lt-container-timeline row">
	<?php $this->load->view('subview/lt_timeline_content_years'); ?>

	<div id="lt-container-timeline-content" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<?php foreach ($curriculum['years'] as $year) { ?>
			<?php $data['year'] = $year; ?>
			<div id="<?php echo $year; ?>" class="lt-container-year-content row">
				<div class="lt-container-year-year row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<span id="lt-container-timeline-year-<?php echo $year; ?>">
							<?php echo $year; ?>
						</span>
					</div>
				</div>
				<div id="lt-container-timeline-academic-content" class="lt-hidden">
					<!-- ***************************** PROJETOS ****************************** -->
					<?php if ( array_key_exists($year, $curriculum['projects']) ) { ?>
						<?php $this->load->view('subview/lt_timeline_content_year_projects', $data); ?>
					<?php } ?>
					<!-- ***************************** PROCUCOES ***************************** -->
					<?php if ( array_key_exists($year, $curriculum['produtcion_books']) 
								|| 
							   array_key_exists($year, $curriculum['production_book_chapters'])
							    ||
							   array_key_exists($year, $curriculum['other_productions']) 
							    ||
							   array_key_exists($year, $curriculum['in_event_productions']) 
							    ||
							   array_key_exists($year, $curriculum['technical_productions'])
							 ) 
					{ ?>
						<?php $this->load->view('subview/lt_timeline_content_year_productions', $data); ?>
					<?php } ?>
					<!-- ***************************** BANCAS ******************************** -->
					<?php if ( array_key_exists($year, $curriculum['master_boards']) 
								|| 
							   array_key_exists($year, $curriculum['qualification_boards']) 
							    || 
							   array_key_exists($year, $curriculum['expertise_boards']) 
							    ||
							   array_key_exists($year, $curriculum['graduation_boards'])
							 ) 
					{ ?>
						<?php $this->load->view('subview/lt_timeline_content_year_boards', $data); ?>
					<?php } ?>
					<!-- ***************************** ORIENCTACOES ************************** -->
					<?php if ( array_key_exists($year, $curriculum['done_master_orientations']) 
								||
							   array_key_exists($year, $curriculum['done_other_orientations']) 
							    ||
							   array_key_exists($year, $curriculum['going_scientific_orientations']) 
							    ||
							   array_key_exists($year, $curriculum['going_mater_orientations'])
							 ) 
					{ ?>
						<?php $this->load->view('subview/lt_timeline_content_year_orientations', $data); ?>
					<?php } ?>
					
				</div>
			</div>
			<hr class="lt-separator"/>

			<input type="hidden" name="chart-years[]" value="<?php echo $year; ?>"/>
		<?php } ?>
	</div>
</div>