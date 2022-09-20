<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('_sitemaster/head'); ?>
		<link href="<?php echo base_url() ?>/assets/customize/css/login-regis.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="login login-body">
		<?php
		    $alert_success = $this->session->flashdata('success');
		    if (isset($alert_success)) {
		        echo '<div class="alert alert-success">' . $alert_success . '</div>';
		         $this->session->unset_userdata('success');
		    }
		    $alert_error = $this->session->flashdata('error');
		    if (isset($alert_error)) {
		        echo '<div class="alert alert-danger">' . $alert_error . '</div>';
		         $this->session->unset_userdata('error');
		    }
		?>
		<div class="wrapper fadeInDown">
			<div id="formContent">
				<div class="fadeIn first">
				  	<img src="<?php echo base_url('assets/logo/logo-owlcats-pict.png');?>" width="100" />
				</div>
				<form method="POST" action="<?php echo base_url('user/do_login'); ?>">
				  	<input type="text" id="username" class="text login fadeIn second" name="username" placeholder="username">
				  	<input type="password" id="password" class="password login fadeIn third" name="password" placeholder="password">
				  	<input type="submit" class="btn-login login fadeIn fourth" value="Log In">
				</form>
				<div id="formFooter">
				  	<a class="login-a underlineHover" href="<?php echo base_url()?>">Home</a>
				  	&nbsp;<span class="login-a">|</span>&nbsp;
				  	<a class="login-a underlineHover" href="#">Forgot Password?</a>
				  	&nbsp;<span class="login-a">|</span>&nbsp;
				  	<a class="login-a underlineHover" href="<?php echo base_url('user/register')?>">Register?</a>
				</div>

			</div>
		</div>
	</body>
	<?php $this->load->view('_sitemaster/foot'); ?>
</html>