<!-- jQuery -->
<script src="{{asset('vendorAdminAssets')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('vendorAdminAssets')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('vendorAdminAssets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('vendorAdminAssets')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('vendorAdminAssets')}}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('vendorAdminAssets')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('vendorAdminAssets')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('vendorAdminAssets')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('vendorAdminAssets')}}/plugins/moment/moment.min.js"></script>
<script src="{{asset('vendorAdminAssets')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('vendorAdminAssets')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('vendorAdminAssets')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('vendorAdminAssets')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('vendorAdminAssets')}}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('vendorAdminAssets')}}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('vendorAdminAssets')}}/dist/js/pages/dashboard.js"></script>
<!-- Select 2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Ckeditor -->
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
@yield('js_additional')
