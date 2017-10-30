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

                </div>


                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#star" data-toggle="tab">
                                <i class="fa fa-star text-yellow" aria-hidden="true"></i> Stars Projects
                                <span class="badge bg-yellow">{{$total['totalStars']}}</span></a>
                        </li>
                        <li><a href="#pending" data-toggle="tab">
                                <i class="fa fa-hourglass-half" aria-hidden="true"></i> Pending Projects
                                <span class="badge">{{$total['totalPending']}}</span></a>
                        </li>
                        <li><a href="#overdue" data-toggle="tab">
                                <i class="fa fa fa-fire text-red" aria-hidden="true"></i> Overdue Projects <span
                                        class="badge bg-red">{{$total['totalOverdue']}}</span></a>
                        </li>
                        <li><a href="#completed" data-toggle="tab">
                                <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                Completed Projects <span class="badge">{{$total['totalCompleted']}}</span></a></li>
                        <li><a href="#all" data-toggle="tab">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                All Projects <span class="badge">{{$total['allProjects']}}</span></a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="star">

                            @if ($starProjects->isNotEmpty())

                                <table id="example1" class="table table-bordered table-striped">
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
                                    @foreach($starProjects as $starProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">

                                                    <a data-toggle="tooltip" data-placement="top" title="View & Edit"
                                                       class="btn btn-xs btn-success"
                                                       href="{{route('projects.show',$starProject->slug)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                    @if($starProject->star==0)
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Star" data-slug="{{$starProject->slug}}" data-value="1"
                                                           data-source="{{route('star')}}" class="ajax btn btn-default btn-xs"> <i
                                                                    class="fa fa-fw fa-star-o"></i></a>
                                                    @else
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Remove from Star" data-slug="{{$starProject->slug}}" data-value="0" data-source="{{route('star')}}"
                                                           class="ajax btn btn-default btn-xs"> <i class="fa fa-fw fa-star"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{$starProject->title}}</td>
                                            <td>{!! statusColor($starProject->status) !!}</td>
                                            <td>{{$starProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$starProject->due_date->format(config('constants.time.format'))}}</td>

                                        </tr>

                                    @endforeach
                                </table>
                            @else

                                <div class="callout callout-info">
                                    <h4> No Stars Projects !</h4>

                                    <p>Please Check Back Later..!</p>
                                </div>

                            @endif


                        </div>

                        <div class="tab-pane" id="pending">

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
                                                    <a data-toggle="tooltip" data-placement="top" title="View & Edit"
                                                       class="btn btn-xs btn-success"
                                                       href="{{route('projects.show',$pendingProject->slug)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                    @if($pendingProject->star==0)
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Star" data-slug="{{$pendingProject->slug}}" data-value="1"
                                                           data-source="{{route('star')}}" class="ajax btn btn-default btn-xs"> <i
                                                                    class="fa fa-fw fa-star-o"></i></a>
                                                    @else
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Remove from Star" data-slug="{{$pendingProject->slug}}" data-value="0" data-source="{{route('star')}}"
                                                           class="ajax btn btn-default btn-xs"> <i class="fa fa-fw fa-star"></i></a>
                                                    @endif
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

                                                    <a data-toggle="tooltip" data-placement="top" title="View & Edit"
                                                       class="btn btn-xs btn-success"
                                                       href="{{route('projects.show',$overdueProject->slug)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                    @if($overdueProject->star==0)
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Star" data-slug="{{$overdueProject->slug}}" data-value="1"
                                                           data-source="{{route('star')}}" class="ajax btn btn-default btn-xs"> <i
                                                                    class="fa fa-fw fa-star-o"></i></a>
                                                    @else
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Remove from Star" data-slug="{{$overdueProject->slug}}" data-value="0" data-source="{{route('star')}}"
                                                           class="ajax btn btn-default btn-xs"> <i class="fa fa-fw fa-star"></i></a>
                                                    @endif
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

                                                    <a data-toggle="tooltip" data-placement="top" title="View & Edit"
                                                       class="btn btn-xs btn-success"
                                                       href="{{route('projects.show',$completedProject->slug)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                    @if($completedProject->star==0)
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Star" data-slug="{{$completedProject->slug}}" data-value="1"
                                                           data-source="{{route('star')}}" class="ajax btn btn-default btn-xs"> <i
                                                                    class="fa fa-fw fa-star-o"></i></a>
                                                    @else
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Remove from Star" data-slug="{{$completedProject->slug}}" data-value="0" data-source="{{route('star')}}"
                                                           class="ajax btn btn-default btn-xs"> <i class="fa fa-fw fa-star"></i></a>
                                                    @endif
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

                                                    <a data-toggle="tooltip" data-placement="top" title="View & Edit"
                                                       class="btn btn-xs btn-success"
                                                       href="{{route('projects.show',$allProject->slug)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                    @if($allProject->star==0)
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Star" data-slug="{{$allProject->slug}}" data-value="1"
                                                           data-source="{{route('star')}}" class="ajax btn btn-default btn-xs"> <i
                                                                    class="fa fa-fw fa-star-o"></i></a>
                                                    @else
                                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Remove from Star" data-slug="{{$allProject->slug}}" data-value="0" data-source="{{route('star')}}"
                                                           class="ajax btn btn-default btn-xs"> <i class="fa fa-fw fa-star"></i></a>
                                                    @endif
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
            $('#example1,#example2,#example3,#example4,#example5').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "order": [[0, "desc"]]
            });
        });


        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.ajax').click(function () {
                var t = $(this);


                var data = {
                    'slug': $(t).attr("data-slug"),
                    'value': $(t).attr("data-value")
                };


                $.ajax({
                    url: $(t).attr("data-source"),
                    data: data,
                    dataType: "json",
                    type: "post",
                    success: function (data) {
                        console.log(data);
                        if (data.success = 'true') {
                            location.reload();
                        }

                    }
                })
            });
        });


    </script>

@endsection