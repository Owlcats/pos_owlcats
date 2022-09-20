<script>
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register("<?=base_url('sw.js')?>").then(function(registration) {
    // Registration was successful
      console.log('ServiceWorker registration successful with scope: ', registration.scope);
    }, function(err) {
      // registration failed :(
      console.log('ServiceWorker registration failed: ', err);
    });
  });
}
</script>
<script src="<?php echo base_url() ?>assets/bootstrap/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- datatables -->
<script src="<?php echo base_url() ?>assets/datatables/datatables/js/jquery.dataTables.min.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/datatables/datatables.min.js"></script> -->
<script src="<?php echo base_url() ?>assets/datatables/datatables/js/dataTables.bootstrap5.min.js"></script>
<!-- end datatables -->
<script src="<?php echo base_url() ?>assets/inputfile/js/plugins/piexif.js"></script>
<script src="<?php echo base_url() ?>assets/inputfile/js/plugins/sortable.js"></script>
<script src="<?php echo base_url() ?>assets/inputfile/js/fileinput.js"></script>
<script src="<?php echo base_url() ?>assets/inputfile/js/locales/fr.js"></script>
<script src="<?php echo base_url() ?>assets/inputfile/js/locales/es.js"></script>
<script src="<?php echo base_url() ?>assets/inputfile/themes/gly/theme.js"></script>
<script src="<?php echo base_url() ?>assets/inputfile/themes/fas/theme.js"></script>
<script src="<?php echo base_url() ?>assets/inputfile/themes/explorer-fas/theme.js"></script>
<script src="<?php echo base_url() ?>assets/summernote/summernote-lite.min.js"></script>

<script src="<?php echo base_url() ?>assets/select2/dist/js/select2.min.js"></script>
<!-- <script>$.fn.fileinput.defaults.theme = 'gly';</script> -->