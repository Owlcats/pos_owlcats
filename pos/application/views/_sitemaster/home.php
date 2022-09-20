<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('_sitemaster/head'); ?>
		<link href="<?php echo base_url() ?>assets/customize/css/home.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="bubbles">
        	<div class="bubble"></div>
        	<div class="bubble"></div>
        	<div class="bubble"></div>
        	<div class="bubble"></div>
        	<div class="bubble"></div>
        	<div class="bubble"></div>
        	<div class="bubble"></div>
        	<div class="bubble"></div>
        	<div class="bubble"></div>
        	<div class="bubble"></div>
        </div>
		<?= $navbar ?>
		<?= $content ?>
	<?php $this->load->view('_sitemaster/foot'); ?>
	</body>
</html>