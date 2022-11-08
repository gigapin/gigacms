                  
            
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div><!-- /. wrapper -->


    <!-- jQuery -->
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="/adminlte/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="/adminlte/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="/adminlte/plugins/moment/moment.min.js"></script>
    <script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/dist/js/adminlte.js"></script>
    <!-- TinyMCE -->
    <script src="/assets/tinymce/tinymce/js/tinymce/tinymce.min.js"></script>
    <!-- Tagify --> 
    <script src="/assets/tagify/dist/jQuery.tagify.min.js"></script>
    <script src="/assets/tagify/dist/tagify.polyfills.min.js"></script>
    <!-- GiGaCMS JavaScript Script -->
    <script src="/assets/js/scripts.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea#editor',
            height: 400,
            plugins: 'image lists table link',
            toolbar: [
                'styles | bold italic | alignleft aligncenter alignright | numlist bullist | link image | table',
            ], 
            images_upload_url: '/uploadFile.php',
            image_uploadtab: true
        });
    </script>

    <script>
        //Date picker
        $('#reservationdate').datetimepicker({
            sideBySide: true,
            format: "YYYY-M-D HH:mm:ss"
        });
        $(function () {
            bsCustomFileInput.init();
        });
    </script>

</body>
</html>