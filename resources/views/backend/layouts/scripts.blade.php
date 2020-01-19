<!-- jQuery -->
<script src="{{asset('assets/backend')}}/plugins/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('js/jquery-ui.min.js')}}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="{{asset('assets/backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="{{asset('assets/backend')}}/plugins/morris/morris.min.js"></script>

<!-- Sparkline -->
<script src="{{asset('assets/backend')}}/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- jvectormap -->
<script src="{{asset('assets/backend')}}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- jQuery Knob Chart -->
<script src="{{asset('assets/backend')}}/plugins/knob/jquery.knob.js"></script>

<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/daterangepicker/daterangepicker.js"></script>

<!-- datepicker -->
<script src="{{asset('assets/backend')}}/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('assets/backend')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- Slimscroll -->
<script src="{{asset('assets/backend')}}/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="{{asset('assets/backend')}}/plugins/fastclick/fastclick.js"></script>

<!-- Select2 -->
<script src="{{asset('assets/backend')}}/plugins/select2/select2.full.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{asset('assets/backend')}}/dist/js/pages/dashboard.js"></script>--}}

<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/backend')}}/dist/js/demo.js"></script>

<!-- iCheck -->
<script src="{{asset('assets/backend')}}/plugins/iCheck/icheck.min.js"></script>

<!-- AdminLTE App -->
<script src="{{asset('assets/backend')}}/dist/js/adminlte.js"></script>

<!-- DataTables -->
<script src="{{ asset('assets/backend')}}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('assets/backend')}}/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- Toastr -->
@toastr_js
@toastr_render

<!-- Dropzone-->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>--}}

<!-- Jquery Validate -->
<script src="{{ asset('js')}}/jquery.validate.min.js"></script>

<!-- Sweet Alert2 JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.js" type="text/javascript"></script>
<!-- Jquery Confirmation CSS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!-- CK Editor -->
<script src="{{ asset('assets/backend')}}/plugins/ckeditor/ckeditor.js"></script>
<script>
    jQuery.validator.addMethod("noSpace", function(value, element) {
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");    
    
    $(document).ready(function(){
        $('.select2').select2({allowClear:true})
    });

</script>
<script src="{{asset('assets/backend/backend.js')}}" type="application/javascript"></script>
<!-- Multiple Image Upload JS-->
<script src="{{asset('js/fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('js/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('js/popper.min.js')}}" type="text/javascript"></script>

<!-- Addmore Jquery Plugin JS -->
<script src="{{asset('js/jquery.fieldsaddmore.min.js')}}" type="text/javascript"></script>
<!-- Custom Validation JS -->
<script src="{{asset('js/validation.js')}}" type="text/javascript"></script>