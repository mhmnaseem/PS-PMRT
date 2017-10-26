@extends('user.layout.master')

@section ('header')

    <link rel="stylesheet"
          href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endsection


@section ('main-content')



    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Projects

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Projects</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">All Projects</h3>
                    {{--<a class="col-md-offset-5 btn btn-success" href="{{route('partner-project-assign.create')}}"> Add--}}
                    {{--New </a>--}}

                    <div class="box-tools pull-right">


                    </div>
                </div>


                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#pending" data-toggle="tab">
                                <i class="fa fa-hourglass-half" aria-hidden="true"></i> Pending Projects
                                <span class="badge">{{$total['totalPending']}}</span></a>
                        </li>
                        <li><a href="#overdue" data-toggle="tab">
                                <i class="fa fa fa-fire text-red" aria-hidden="true"></i> Overdue Projects <span
                                        class="badge bg-red">{{$total['totalOverdue']}}</span></a>
                        </li>
                        <li><a href="#completed" data-toggle="tab">
                                <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                Completed Projects<span class="badge">{{$total['totalCompleted']}}</span></a></li>
                        <li><a href="#all" data-toggle="tab">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                All Projects <span class="badge">{{$total['allProjects']}}</span></a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="pending">

                            @if ($pendingProjects->isNotEmpty())

                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Start date</th>
                                        <th>Due date</th>



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pendingProjects as $pendingProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">

                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{route('partner-project-assign.edit',$pendingProject->slug)}}"><i
                                                                class="fa fa-fw fa-edit"></i></a>

                                                </div>
                                            </td>
                                            <td>{{$pendingProject->title}}</td>
                                            <td>{!! statusColor($pendingProject->status) !!}</td>
                                            <td>{{$pendingProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$pendingProject->due_date->format(config('constants.time.format'))}}</td>

                                        </tr>

                                    @endforeach
                                </table>
                            @else

                                <div class="callout callout-info">
                                    <h4> No Pending Projects !</h4>

                                    <p>Please Check Back Later..!</p>
                                </div>

                            @endif


                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="overdue">

                            @if ($overdueProjects->isNotEmpty())


                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Start date</th>
                                        <th>Due date</th>



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($overdueProjects as $overdueProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">

                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{route('partner-project-assign.edit',$overdueProject->slug)}}"><i
                                                                class="fa fa-fw fa-edit"></i></a>

                                                </div>
                                            </td>
                                            <td>{{$overdueProject->title}}</td>
                                            <td>{!! statusColor($overdueProject->status) !!}</td>
                                            <td>{{$overdueProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{!! '<small>'.$overdueProject->due_date->format(config('constants.time.format')).'</small> '. dueDays($overdueProject->due_date)  !!}</td>



                                        </tr>
                                    @endforeach
                                </table>

                            @else

                                <div class="callout callout-info">
                                    <h4>No Overdue Projects !</h4>

                                    <p>Please Check Back Later..!</p>
                                </div>

                            @endif
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="completed">

                            @if ($completedProjects->isNotEmpty())

                                <table id="example4" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Start date</th>
                                        <th>Due date</th>



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($completedProjects as $completedProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">

                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{route('partner-project-assign.edit',$completedProject->slug)}}"><i
                                                                class="fa fa-fw fa-edit"></i></a>

                                                </div>
                                            </td>
                                            <td>{{$completedProject->title}}</td>
                                            <td>{!! statusColor($completedProject->status) !!}</td>
                                            <td>{{$completedProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$completedProject->due_date->format(config('constants.time.format'))}}</td>



                                        </tr>
                                    @endforeach
                                </table>
                            @else

                                <div class="callout callout-info">
                                    <h4> No Completed Projects !</h4>

                                    <p>Please Check Back Later..!</p>
                                </div>

                            @endif
                        </div>
                        <!-- /.tab-pane -->

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="all">

                            @if ($allProjects->isNotEmpty())

                                <table id="example5" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Start date</th>
                                        <th>Due date</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allProjects as $allProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">

                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{route('partner-project-assign.edit',$allProject->slug)}}"><i
                                                                class="fa fa-fw fa-edit"></i></a>

                                                </div>
                                            </td>
                                            <td>{{$allProject->title}}</td>
                                            <td>{!! statusColor($allProject->status) !!}</td>
                                            <td>{{$allProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$allProject->due_date->format(config('constants.time.format'))}}</td>



                                        </tr>
                                    @endforeach
                                </table>
                            @else

                                <div class="callout callout-info">
                                    <h4> No Projects !</h4>

                                    <p>Please Check Back Later..!</p>
                                </div>

                            @endif
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->



                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

@section('footer')

    <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "order": [[0, "desc"]]
            });
            $('#example3').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "order": [[0, "desc"]]
            });
            $('#example4').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "order": [[0, "desc"]]
            });
            $('#example5').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "order": [[0, "desc"]]
            });
        });


    </script>

@endsection