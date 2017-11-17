<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y");?> <a href="http://www.donwebsolutions.com/">Don Web Solutions</a>.</strong> All rights
    reserved.
</footer>

<!-- jQuery 3 -->
<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- moment -->
<script src="{{asset('admin/bower_components/moment/min/moment.min.js')}}"></script>
<!-- date time picker-->
<script src="{{asset('admin/bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- ck editor -->
<script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>


<!-- custom js -->
<script src="{{asset('admin/dist/js/custom.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
{{--<!-- AdminLTE dashboard demo (This is only for demo purposes) -->--}}
{{--<script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>--}}
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="{{asset('admin/dist/js/demo.js')}}"></script>--}}

@section('footer')
@show

