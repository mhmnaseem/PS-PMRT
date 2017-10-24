<!DOCTYPE html>
<html>
<head>
 @include('partner.layout.head')
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    @include('partner.layout.header')
    @include('partner.layout.sidebar')

    @section('main-content')
        @show


    @include('partner.layout.footer')


</div>
<!-- ./wrapper -->


</body>
</html>