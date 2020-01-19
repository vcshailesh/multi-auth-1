<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('title')
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      
    {{-- Include styles files--}}
    @include('backend.layouts.styles')
    @yield('after-styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    {{--Include Navbar --}}
    @include('backend.layouts.header')
    <!-- Main Sidebar Container -->
    @include('backend.layouts.sidebar')
    @yield('content')
    <!-- Footer Container-->
        @include('backend.layouts.footer')
</div>
<!-- ./wrapper -->

{{--Include scripts files--}}
@include('backend.layouts.scripts')
@yield('after-scripts')
</body>
</html>
