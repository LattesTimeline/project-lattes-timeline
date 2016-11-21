<div id="lt-modal-mask"></div>

<div id="lt-modal-chart">
	<div class="lt-chart-container-legend row">
		<div class="lt-chart-legend-projects col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<span class="lt-chart-legend">&nbsp;</span>
			<span><?php echo lang('lt_label_research_projects'); ?></span>
		</div>
		<div class="lt-chart-legend-productions col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<span class="lt-chart-legend">&nbsp;</span>
			<span><?php echo lang('lt_label_productions'); ?></span>
		</div>
		<div class="lt-chart-legend-boards col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<span class="lt-chart-legend">&nbsp;</span>
			<span><?php echo lang('lt_label_boards'); ?></span>
		</div>
		<div class="lt-chart-legend-orientations col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<span class="lt-chart-legend">&nbsp;</span>
			<span><?php echo lang('lt_label_orientations'); ?></span>
		</div>
	</div>
	
	<div class="lt-chart-container-chart row">
		<div class="lt-chart-container-filter-years col-xs-1 col-sm-1 col-md-1 col-lg-1">
			<!--
			<div class="lt-chart-container-width row">
				<input type="number" name="lt-chart-width"/>
			</div>
			-->
			<div class="lt-chart-filter-years row">
				<?php foreach ($curriculum['years'] as $year) { ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<input id="lt-chart-filter-year-<?php echo $year; ?>" type="checkbox" 
						 name="lt-chart-filter-year-<?php echo $year; ?>" value="<?php echo $year; ?>" checked/>
						<label for="lt-chart-filter-year-<?php echo $year; ?>">
							<?php echo $year; ?>
						</label>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="lt-chart col-xs-11 col-sm-11 col-md-11 col-lg-11">
			<canvas id="lt-chart"></canvas>
		</div>
	</div>
</div>

<div id="lt-chart-tooltip"></div>
