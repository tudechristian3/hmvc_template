 <!-- All Jquery -->
    <!-- ============================================================== -->
    <input type="hidden" class="base_url" value="<?php echo base_url(); ?>"/>
    <script src="<?php echo base_url('assets/')?>node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="<?php echo base_url('assets/')?>node_modules/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url('assets/')?>node_modules/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url('assets/')?>node_modules/ps/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url('assets/')?>js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url('assets/')?>js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url('assets/')?>js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="<?php echo base_url('assets/')?>node_modules/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url('assets/')?>node_modules/morrisjs/morris.min.js"></script>
    <!--c3 JavaScript -->
    <script src="<?php echo base_url('assets/')?>node_modules/d3/d3.min.js"></script>
    <script src="<?php echo base_url('assets/')?>node_modules/c3-master/c3.min.js"></script>
    <!-- Popup message jquery -->
    <script src="<?php echo base_url('assets/')?>node_modules/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    <script src="<?php echo base_url('assets/')?>js/dashboard1.js"></script>
    <script src="<?php echo base_url('assets/')?>js/user.js"></script>
    <script src="<?php echo base_url('assets/')?>js/employee.js"></script>
    <script src="<?php echo base_url('assets/')?>js/product.js"></script>
    <script src="<?php echo base_url('assets/')?>js/post.js"></script>

    <script src="<?php echo base_url('assets/')?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/')?>js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/')?>package/dist/sweetalert2.all.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url('assets/')?>node_modules/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="<?php echo base_url('assets/')?>node_modules/dropify/dist/js/dropify.min.js"></script>

    <script>
    $(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
</body>

</html>