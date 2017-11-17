@extends('user.layout.master')

@section ('header')

    <link rel="stylesheet"
          href="{{asset('admin/dist/css/lightbox.min.css')}}">

@endsection



@section ('main-content')



    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>

                Expenses

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Project Details</a></li>
                <li><a href="#">Expenses</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$expense->expense_type}}</h3>
                </div>
                <div class="box-body">
                    <!-- /.box-body -->
                    <div class="row">
                        <div class="col-sm-8">

                            <h5><strong>Expenses Description</strong></h5>
                            <hr>


                            {!! htmlspecialchars_decode($expense->description) !!}


                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="box">
                                <div class="box-header with-border">
                                    <div class="btn-group">

                                        <a data-toggle="tooltip" data-placement="top" title="Edit"
                                           class="btn btn-xs btn-warning"
                                           href="{{url('pm/projects/'.$slug.'/expense/'.$expense->id.'/edit')}}"><i
                                                    class="fa fa-fw fa-2x fa-edit" aria-hidden="true"></i></a>
                                        <a data-toggle="tooltip" data-placement="top" title="Go Back"
                                           class="btn btn-xs btn-info"
                                           href="{{url('pm/projects/'.$slug.'#expenses')}}"><i
                                                    class="fa fa-fw fa-2x fa-angle-double-left" aria-hidden="true"></i></a>

                                    </div>
                                </div>
                                <div class="box-body">
                                    <strong><i class="fa fa-money text-maroon margin-r-5"></i> Amount</strong>

                                    <p class="text-muted">
                                        ${{number_format($expense->amount,2)}}
                                    </p>
                                    <hr>

                                    <strong><i class="fa fa-calendar text-maroon margin-r-5"></i> Date</strong>

                                    <p class="text-muted">{{$expense->date->format(config('constants.time.format'))}}</p>

                                    <hr>
                                    <strong><i class="fa fa-picture-o text-maroon margin-r-5"></i>
                                        Attachment</strong>

                                    <div class="img-box">
                                        <a href="{{asset(config('constants.upload_path.attachments').$expense->attachment_url)}}"
                                           data-lightbox="{{$expense->id}}"
                                           data-title="{{$expense->expense_type}}"><img
                                                    class="img-responsive"
                                                    src="{{asset(config('constants.upload_path.attachments').$expense->attachment_url)}}"></a>

                                    </div>


                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box -->
            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

@section('footer')
    <script src="{{asset('admin/dist/js/lightbox.min.js')}}"></script>

@endsection