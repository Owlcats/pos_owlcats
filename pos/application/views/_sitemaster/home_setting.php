<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<?php $this->load->view('_sitemaster/head'); ?>
		<link href="<?php echo base_url() ?>/assets/customize/css/sidebar-company_setting.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="container-fluid">
			<div class="row min-vh-100 flex-column flex-md-row">
				<?= $sidebar ?>	
				<main class="col-md-9 px-0 flex-grow-1">
					<div class="container py-3">
						<div class="row">
							<div class="col-md-12 title-company-setting">
								<div class="text-info fs-4 fst-italic fw-bolder">
									<ins><?= $title ?></ins>
								</div>

							</div>
							<div class="col-md-12">
								<?php
								    $alert_success = $this->session->flashdata('success');
								    if (isset($alert_success)) {
								        echo '<div class="col-md-12"><div class="alert alert-success" role="alert">' . $alert_success . '</div></div>';
								         $this->session->unset_userdata('success');
								    }
								    $alert_error = $this->session->flashdata('error');
								    if (isset($alert_error)) {
								        echo '<div class="col-md-12"><div class="alert alert-danger" role="alert">' . $alert_error . '</div></div>';
								         $this->session->unset_userdata('error');
								    }
								?>
								<?= $content ?>
							</div>
						</div>
					</div>
				</main>
			</div>
		</div>
	<?php $this->load->view('_sitemaster/foot'); ?>
	</body>
</html>
<script src="<?php echo base_url() ?>/assets/customize/js/sidebar-company_setting.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var current = location.pathname.split("/")[2]+'/'+location.pathname.split("/")[3];
	    $('#nav li a').each(function(){
	        var $this = $(this);
	        if($this.attr('id') == current){
	            $this.addClass('active');
	        }
	    })
	    $('#company_setting').DataTable( {
	        // responsive: true,
	        scrollX: true
	    } );
	    $("#input_pict").fileinput({
	        'theme': 'explorer-fas'
	    });
	    $('.fileinput-upload-button').hide();
	    $('.select2_single').select2({
	    	theme: "bootstrap-5",
	    	width: '100%'
	    });
	    $(document).on('select2:open', () => {
	        document.querySelector('.select2-search__field').focus();
	    });
	    $('.select2_single').on("change", function() {
			$('.select2_single').select2('close');
		});
		$('#summernote').summernote({
			height: 290,
	        toolbar: [
	          	['style', ['style']],
	          	['font', ['bold', 'underline', 'clear']],
	          	['color', ['color']],
	          	['para', ['ul', 'ol', 'paragraph']],
	          	['table', ['table']],
	          	['view', ['fullscreen', 'codeview', 'help']]
	        ]
		});
		$('#summernote2').summernote({
			height: 290,
	        toolbar: [
	          	['style', ['style']],
	          	['font', ['bold', 'underline', 'clear']],
	          	['color', ['color']],
	          	['para', ['ul', 'ol', 'paragraph']],
	          	['table', ['table']],
	          	['view', ['fullscreen', 'codeview', 'help']]
	        ]
		});
		$('#summernote3').summernote({
			height: 200,
	        toolbar: [
	          	['style', ['style']],
	          	['font', ['bold', 'underline', 'clear']],
	          	['color', ['color']],
	          	['para', ['ul', 'ol', 'paragraph']],
	          	['table', ['table']],
	          	['view', ['fullscreen', 'codeview', 'help']]
	        ]
		});
	});
</script>