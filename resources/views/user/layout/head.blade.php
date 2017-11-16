<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>@yield('title',"PS-PMRT")</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
<!-- Date time Picker -->
<link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}">

<!-- Data Table -->
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet"
      href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
<link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">
<!-- pace -->
<link rel="stylesheet" href="{{asset('admin/plugins/pace/pace.min.css')}}">

<!-- custom css -->
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

@section('header')
    @show