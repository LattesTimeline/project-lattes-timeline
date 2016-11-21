			</div>
		</div>

		<div>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/libraries/jquery-1.11.3.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/libraries/bootstrap.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/lt-constants.js" async></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/lt-general.js" async></script>
			
			<?php preg_match('/\/index.php\/lt_timeline_generator|\/lt_timeline_generator|\/timeline-generator/', $_SERVER['REQUEST_URI'], $timeline); ?>
		    <?php if (!empty($timeline)) { ?>
		    	<?php $this->load->view('chart/lt_chart'); ?>
		    	
				<script type="text/javascript" src="<?php echo base_url(); ?>js/subview/lt-timeline.js" async></script>
				<script type="text/javascript" src="<?php echo base_url(); ?>js/subview/lt-timeline-filter.js" async></script>
				<script type="text/javascript" src="<?php echo base_url(); ?>js/subview/lt-timeline-content-years.js" async></script>

				<script type="text/javascript" src="<?php echo base_url(); ?>js/libraries/chart.min.js" async></script>
				<script type="text/javascript" src="<?php echo base_url(); ?>js/chart/lt-timeline-charts.js" async></script>
		    <?php } ?>
		</div>
	</body>
</html>