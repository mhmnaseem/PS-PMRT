<!DOCTYPE html>
<html>
<head>
 @include('admin.layout.head')
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    @include('admin.layout.header')
    @include('admin.layout.sidebar')

    @section('main-content')
        @show


    @include('admin.layout.footer')


</div>
<!-- ./wrapper -->


</body>
</html>