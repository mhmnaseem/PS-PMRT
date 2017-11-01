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

                Onsite Delivery/Go Live

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Project Details</a></li>
                <li><a href="{{url('pm/projects/'.$slug.'#onsite-delivery-go-live')}}">Onsite Delivery/Go Live</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$onsiteDeliveryGoLive->location}}</h3>
                </div>
                <div class="box-body">
                    <!-- /.box-body -->
                    <div class="row">
                        <div class="col-sm-8">

                            <h5><strong>Onsite Delivery/Go Live Comment</strong></h5>
                            <hr>


                            {!! htmlspecialchars_decode($onsiteDeliveryGoLive->comment) !!}


                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="box">
                                <div class="box-header with-border">
                                    <div class="btn-group">

                                        <a data-toggle="tooltip" data-placement="top" title="Edit"
                                           class="btn btn-xs btn-warning"
                                           href="{{url('pm/projects/'.$slug.'/onsite-delivery-go-live/'.$onsiteDeliveryGoLive->id.'/edit')}}"><i
                                                    class="fa fa-fw fa-2x fa-edit" aria-hidden="true"></i></a>
                                        <a data-toggle="tooltip" data-placement="top" title="Go Back"
                                           class="btn btn-xs btn-info"
                                           href="{{url('pm/projects/'.$slug.'#onsite-delivery-go-live')}}"><i
                                                    class="fa fa-fw fa-2x fa-angle-double-left" aria-hidden="true"></i></a>

                                    </div>
                                </div>
                                <div class="box-body">
                                    <strong><i class="fa fa-calendar text-maroon margin-r-5"></i> Start Date</strong>

                                    <p class="text-muted">{{$onsiteDeliveryGoLive->start_date->format(config('constants.time.format'))}}</p>

                                    <hr>

                                    <strong><i class="fa fa-calendar text-maroon margin-r-5"></i> End Date</strong>

                                    <p class="text-muted">
                                        @if($onsiteDeliveryGoLive->end_date != '')
                                            {{$onsiteDeliveryGoLive->end_date->format(config('constants.time.format'))}}
                                        @endif
                                    </p>

                                    <hr>
                                    <strong><i class="fa fa-check-circle text-maroon margin-r-5"></i>
                                        Status</strong>

                                    <p>
                                        {!! statusColor($onsiteDeliveryGoLive->status) !!}
                                    </p>

                                    <hr>

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