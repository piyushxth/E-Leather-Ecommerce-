<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>{{ $title }} |{{ env('APP_NAME') }}</title>
      <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Select2 -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
      <!-- Bootstrap4 Duallistbox -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Tempusdominus Bbootstrap 4 -->
      <link rel="stylesheet"
         href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- JQVMap -->
      {{--
      <link rel="stylesheet" href="{{asset('backend/plugins/jqvmap/jqvmap.min.css')}}">
      --}}
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      <!-- DataTables -->
      <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
      <!--Toast-->
      <link rel="stylesheet" href="{{ asset('backend/toast/build/toastr.min.css') }}">
      <link rel="stylesheet" href="{{ asset('backend/dist/css/custom.css') }}">
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- Navbar -->
         @include('backend.layouts.header')
         <!-- /.navbar -->
         @include('backend.layouts.sidebar')
         <!-- Content Wrapper. Contains page content -->
         @yield('content')
         <!-- /.content-wrapper -->
         <!-- Control Sidebar -->
         <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
         </aside>
         <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->
      @include('backend.layouts.footer')
      <!-- jQuery -->
      <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
      <script>
         $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- Tempusdominus Bootstrap 4 -->
      <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
      <!-- overlayScrollbars -->
      <script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
      <!-- AdminLTE App -->
      <!-- DataTables -->
      <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
      <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
      <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      {{-- <script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script> --}}
      <!-- AdminLTE for demo purposes -->
      <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
      {{-- Toast --}}
      <script src="{{ asset('backend/toast/build/toastr.min.js') }}"></script>
      <script src="{{ asset('backend/dist/js/ntc.js') }}"></script>
      @yield('script')
      {{-- Notification --}}
      <script>
         @if (session()->has('success_msg'))
             toastr.success("{{ session()->get('success_msg') }}", 'Success', {closeButton :true, positionClass:
             "toast-top-right", timeOut: 1000 ,progressBar:true })
         @elseif( session()->has('error_msg') )
             toastr.info("{{ session()->get('error_msg') }}", 'OOps!', {closeButton :true, positionClass:
             "toast-top-right",timeOut: 1000 ,progressBar:true} )
         @endif
      </script>
      <!-- page script -->
      <script type="text/javascript">
         $(function() {
             // $("#example1").DataTable();
             $('#example1').DataTable({
                 "paging": true,
                 "pageLength": 30,
                 "lengthChange": true,
                 "searching": true,
                 "ordering": false,
                 "info": true,
                 "autoWidth": false,
             });

             $('#product_images').DataTable({
                 "paging": true,
                 "pageLength": 30,
                 "lengthChange": true,
                 "searching": false,
                 "ordering": false,
                 "info": true,
                 "autoWidth": false,
             });

             //Initialize Select2 Elements
             $('.select2').select2()

             //Initialize Select2 Elements
             $('.select2bs4').select2({
                 theme: 'bootstrap4'
             });
         });
      </script>
   </body>
</html>
