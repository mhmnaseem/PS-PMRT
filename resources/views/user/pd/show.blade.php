@extends('user.layout.master')

@section ('header')



@endsection



@section ('main-content')



    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>

                Planning and Design

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Project Details</a></li>
                <li><a href="#">Planning and Design</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$pd->title}}</h3>
                </div>
                <div class="box-body">
                    <!-- /.box-body -->
                    <div class="row">
                        <div class="col-sm-8">

                            <h5><strong>Planning and Design Comment</strong></h5>
                            <hr>


                            {!! htmlspecialchars_decode($pd->comment) !!}


                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="box">
                                <div class="box-header with-border">
                                    <div class="btn-group">

                                        <a data-toggle="tooltip" data-placement="top" title="Edit"
                                           class="btn btn-xs btn-warning"
                                           href="{{url('pm/projects/'.$slug.'/pd/'.$pd->id.'/edit')}}"><i
                                                    class="fa fa-fw fa-2x fa-edit" aria-hidden="true"></i></a>
                                        <a data-toggle="tooltip" data-placement="top" title="Go Back"
                                           class="btn btn-xs btn-info"
                                           href="{{url('pm/projects/'.$slug.'#pd')}}"><i
                                                    class="fa fa-fw fa-2x fa-angle-double-left" aria-hidden="true"></i></a>

                                    </div>
                                </div>
                                <div class="box-body">

                                    <strong><i class="fa fa-calendar text-maroon margin-r-5"></i> Start Date</strong>

                                    <p class="text-muted">{{$pd->start_date->format(config('constants.time.format'))}}</p>

                                    <hr>

                                    <strong><i class="fa fa-calendar text-maroon margin-r-5"></i> End Date</strong>

                                    <p class="text-muted">
                                        @if($pd->end_date != '')
                                            {{$pd->end_date->format(config('constants.time.format'))}}
                                        @endif
                                    </p>

                                    <hr>
                                    <strong><i class="fa fa-clock-o text-maroon margin-r-5"></i> Time Spent</strong>

                                    <p class="text-muted">
                                        {!! timeSpent($pd->start_date,$pd->end_date) !!}
                                    </p>

                                    <hr>
                                    <strong><i class="fa fa-check-circle text-maroon margin-r-5"></i>
                                        Status</strong>

                                    <p>
                                        {!! statusColor($pd->status) !!}
                                    </p>


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


@endsection