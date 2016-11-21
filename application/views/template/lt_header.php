<html lang='pt'>
<head>
	<title><?php echo lang('lt_app_name'); ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset= utf-8 (Sem BOM)" />

	<link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/libraries/bootstrap.css" type="text/css" media="screen">

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/lt-general.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/template/lt-header.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/template/lt-menu.css" type="text/css" media="screen">

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/lt-index.css" type="text/css" media="screen">
	
	<?php preg_match('/\/index.php\/lt_timeline_generator|\/lt_timeline_generator|\/timeline-generator/', $_SERVER['REQUEST_URI'], $timeline); ?>
    <?php if (!empty($timeline)) { ?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/lt-timeline.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/subview/lt-timeline-filter.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/subview/lt-timeline-content.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/subview/lt-timeline-content-years.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/subview/lt-timeline-content-year-projects.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/subview/lt-timeline-content-year-productions.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/subview/lt-timeline-content-year-boards.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/subview/lt-timeline-content-year-orientations.css" type="text/css" media="screen">

		<link rel="stylesheet" href="<?php echo base_url(); ?>css/chart/lt-timeline-charts.css" type="text/css" media="screen">
    <?php } ?>

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/special/minor.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/mobile/mobile-portrait.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/mobile/mobile-landscape.css" type="text/css" media="screen">
</head>
<body>
	<div class="lt-container-header row">
		<div class="lt-container-left-logo col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<a title="<?php echo lang('lt_title_logo'); ?>" href="<?php echo base_url(); ?>">
				<img alt="<?php echo lang('lt_alt_image_logo'); ?>"
				 src="<?php echo base_url(); ?>images/img-logo-lattes-timeline.png"/>
			</a>
		</div>
		<div class="lt-container-center-logo col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 
						col-xs-4 col-sm-4 col-md-2 col-lg-2 lt-logo-image-left">
				<a title="<?php echo lang('lt_title_logo'); ?>" href="<?php echo base_url(); ?>">
					<img class="img-responsive"
					 alt="<?php echo lang('lt_alt_image_logo'); ?>" 
					 src="<?php echo base_url(); ?>images/background-logo-left.png"/>
				</a>
			</div>
			<div class="lt-logo-image-center col-xs-4 col-sm-4 col-md-2 col-lg-2">
				<a title="<?php echo lang('lt_title_logo'); ?>" href="<?php echo base_url(); ?>">
					<img class="img-responsive"
					 alt="<?php echo lang('lt_alt_image_logo'); ?>" 
					 src="<?php echo base_url(); ?>images/background-logo-center.png"/>
				</a>
			</div>
			<div class="lt-logo-image-right col-xs-4 col-sm-4 col-md-2 col-lg-2">
				<a title="<?php echo lang('lt_title_logo'); ?>" href="<?php echo base_url(); ?>">
					<img class="img-responsive"
					 alt="<?php echo lang('lt_alt_image_logo'); ?>" 
					 src="<?php echo base_url(); ?>images/background-logo-right.png"/>
				</a>
			</div>
			<div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-5 col-lg-offset-5 
						col-xs-6 col-sm-6 col-md-3 col-lg-3 lt-logo-text-center">
				<a title="<?php echo lang('lt_title_logo'); ?>" href="<?php echo base_url(); ?>">
					<img class="lt-logo"
					 alt="<?php echo lang('lt_alt_image_logo'); ?>" 
					 src="<?php echo base_url(); ?>images/img-logo.png"/>
				</a>
			</div>
		</div>
	</div>
	