<!DOCTYPE html>
    <html lang="en">
    <head>
    	<?php $this->load->view('_sitemaster/head'); ?>
        <link href="<?php echo base_url() ?>/assets/customize/css/sidebar-pos.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	<?=$sidebar?>
    	<main>
            <!-- <?=$header?> -->
            <!-- <div class="header-pos">
                <div class="row">
                    <div class="col">
                        <div class="col-md-12">
                            <span class="text-title-head"><strong>PENGELUARAN</strong></span>
                        </div>
                        <div>&nbsp;</div>
                        <div class="col-md-12">
                            <span class="text-title-head"><strong>Rp. 0,00</strong></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="col-md-12 text-end">
                            <span class="text-title-head"><strong>PENJUALAN</strong></span>
                        </div>
                        <div>&nbsp;</div>
                        <div class="col-md-12 text-end">
                            <span class="text-title-head"><strong>Rp. 0,00</strong></span>
                        </div>
                    </div>
                </div>
            </div> -->
            <div>&nbsp;</div>
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
            </div>
    		<?=$content?>
            <div class="d-flex align-items-center justify-content-end plus">
                <img src="<?=base_url('assets/icons/icon_svg/plus.svg')?>" class="img-plus" onclick="add_trans();">
            </div>
            <div class="col-md-12 keranjang">
                <!-- content -->
            </div>
            <footer class="footer d-flex align-items-center justify-content-center">
                <a href="<?=base_url('pos/')?>" class="nav__link">
                    <i class="fas fa-home nav__icon"></i>
                </a>
            </footer>
    	</main>
    </body>
    <?php $this->load->view('_sitemaster/foot'); ?>
    <script src="<?php echo base_url() ?>/assets/customize/js/sidebar-pos.js"></script>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        var current = location.pathname.split("/")[2]+'/'+location.pathname.split("/")[3];
        $('.nav__link').each(function(){
            var $this = $(this);
            if($this.attr('id') == current){
                $this.addClass('active');
            }
        });
        $("#input_pict").fileinput({
            'theme': 'explorer-fas'
        });
        $('.fileinput-upload-button').hide();
        $('.select2_single').select2();
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        $('.select2_single').on("change", function() {
            $('.select2_single').select2('close');
        });
    });

    function add_trans(){
        window.location.href = "<?=base_url('pos/add_trans');?>";
    }
</script>