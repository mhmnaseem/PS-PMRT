<!DOCTYPE html>
<html>
<head>
 @include('user.layout.head')
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    @include('user.layout.header')
    @include('user.layout.sidebar')

    @section('main-content')
        @show


    @include('user.layout.footer')


</div>
<!-- ./wrapper -->


</body>
</html>