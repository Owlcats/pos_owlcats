<div class="nav_owlcats">
	<nav class="navbar navbar-light bg-light">
		<div class="container-fluid">
		  	<a class="navbar-brand" href="<?= base_url() ?>">
		    	<img src="<?php echo base_url('assets/logo/logo-owlcats-pict.png'); ?>" width="30" height="24" class="d-inline-block align-top" alt="">
		    	<img src="<?php echo base_url('assets/logo/logo-owlcats-text.png'); ?>" width="100" height="24" class="d-inline-block align-top" alt="">
		  	</a>
		  	<form class="form-inline">
		  		<button class="btn btn-outline-primary" type="button" onclick="login();">Login</button>
		  	</form>
	  	</div>
	</nav>
</div>
<script type="text/javascript">
	function login(){
		window.location.href = "<?= base_url('user/login') ?>";
	}
</script>