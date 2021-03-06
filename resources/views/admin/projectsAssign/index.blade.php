@extends('admin.layout.master')

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
                    <a class="col-md-offset-5 btn btn-success" href="{{route('admin-project-assign.create')}}"> Add
                        New </a>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>

                    </div>
                </div>


                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#pending" data-toggle="tab">
                                <i class="fa fa-hourglass-half" aria-hidden="true"></i> PM Unassigned
                                <span class="badge">{{$total['totalPending']}}</span></a>
                        </li>
                        <li><a href="#assigned" data-toggle="tab">
                                <i class="fa fa-random" aria-hidden="true"></i> PM Assigned <span
                                        class="badge">{{$total['totalAssigned']}}</span></a>
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
                        <div class="tab-pane active" id="pending">

                            @if ($pendingProjects->isNotEmpty())

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Start date</th>
                                        <th>Due date</th>
                                        <th>Partner</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pendingProjects as $pendingProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    {{--<a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-xs btn-default"--}}
                                                    {{--href="{{route('admin-project-assign.show',$project->id)}}"><i--}}
                                                    {{--class="fa fa-fw fa-arrow-circle-right"></i></a>--}}
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{route('admin-project-assign.edit',$pendingProject->id)}}"><i
                                                                class="fa fa-fw fa-edit"></i></a>


                                                    <form id="form-delete-{{$pendingProject->id}}" method="post"
                                                          action="{{route('admin-project-assign.destroy',$pendingProject->id)}}"
                                                          style="display: none;">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}

                                                    </form>

                                                    <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                       class="btn btn-xs btn-danger" href="#" onclick="

                                                            if(confirm('Are you sure want to Delete?')) {
                                                            event.preventDefault();
                                                            document.getElementById('form-delete-{{$pendingProject->id}}').submit();
                                                            }else{
                                                            event.preventDefault();
                                                            }

                                                            "><i class="fa fa-fw fa-trash"></i></a>
                                                </div>
                                            </td>
                                            <td>{{$pendingProject->title}}</td>
                                            <td>{!! statusColor($pendingProject->status) !!}</td>
                                            <td>{{$pendingProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$pendingProject->due_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$pendingProject->partner->name}}</td>
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
                        <div class="tab-pane" id="assigned">

                            @if ($assignedProjects->isNotEmpty())


                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Progress</th>
                                        <th>Start date</th>
                                        <th>Due date</th>
                                        <th>Partner</th>
                                        <th>Assigned PM</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($assignedProjects as $assignedProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    {{--<a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-xs btn-default"--}}
                                                    {{--href="{{route('admin-project-assign.show',$project->id)}}"><i--}}
                                                    {{--class="fa fa-fw fa-arrow-circle-right"></i></a>--}}
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{route('admin-project-assign.edit',$assignedProject->id)}}"><i
                                                                class="fa fa-fw fa-edit"></i></a>


                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                       title="Snap Shot"
                                                       data-slug="{{$assignedProject->slug}}"
                                                       data-title="{{$assignedProject->title}}"
                                                       data-source="{{route('snap.shot')}}"
                                                       class="open-snap btn btn-default btn-xs"> <i
                                                                class="fa fa-fw fa-camera"></i></a>

                                                    <a href="{{route('expense.export',$assignedProject->slug)}}"
                                                       data-toggle="tooltip" data-placement="top" title="Expense Report"
                                                       class="btn btn-default btn-xs"> <i
                                                                class="fa fa-fw fa-file"></i></a>

                                                    <form id="form-delete-{{$assignedProject->id}}" method="post"
                                                          action="{{route('admin-project-assign.destroy',$assignedProject->id)}}"
                                                          style="display: none;">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}

                                                    </form>

                                                    <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                       class="btn btn-xs btn-danger" href="#" onclick="

                                                            if(confirm('Are you sure want to Delete?')) {
                                                            event.preventDefault();
                                                            document.getElementById('form-delete-{{$assignedProject->id}}').submit();
                                                            }else{
                                                            event.preventDefault();
                                                            }

                                                            "><i class="fa fa-fw fa-trash"></i></a>
                                                </div>
                                            </td>
                                            <td>{{$assignedProject->title}}</td>
                                            <td>{!! statusColor($assignedProject->status) !!}</td>
                                            <td>{!! calculateProgress($assignedProject->slug) !!}</td>
                                            <td>{{$assignedProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$assignedProject->due_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$assignedProject->partner->name}}</td>
                                            <td>{{$assignedProject->pm->name}}</td>


                                        </tr>
                                    @endforeach
                                </table>

                            @else

                                <div class="callout callout-info">
                                    <h4>No PM Assigned Project!</h4>

                                    <p>Please Check Back Later..!</p>
                                </div>

                            @endif
                        </div>
                        <div class="tab-pane" id="overdue">

                            @if ($overdueProjects->isNotEmpty())


                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Progress</th>
                                        <th>Start date</th>
                                        <th>Due date</th>
                                        <th>Partner</th>
                                        <th>Assigned PM</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($overdueProjects as $overdueProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">

                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{route('admin-project-assign.edit',$overdueProject->id)}}"><i
                                                                class="fa fa-fw fa-edit"></i></a>

                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                       title="Snap Shot"
                                                       data-slug="{{$overdueProject->slug}}"
                                                       data-title="{{$overdueProject->title}}"
                                                       data-source="{{route('snap.shot')}}"
                                                       class="open-snap btn btn-default btn-xs"> <i
                                                                class="fa fa-fw fa-camera"></i></a>

                                                    <a href="{{route('expense.export',$overdueProject->slug)}}"
                                                       data-toggle="tooltip" data-placement="top" title="Expense Report"
                                                       class="btn btn-default btn-xs"> <i
                                                                class="fa fa-fw fa-file"></i></a>

                                                    <form id="form-delete-{{$overdueProject->id}}" method="post"
                                                          action="{{route('admin-project-assign.destroy',$overdueProject->id)}}"
                                                          style="display: none;">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}

                                                    </form>

                                                    <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                       class="btn btn-xs btn-danger" href="#" onclick="

                                                            if(confirm('Are you sure want to Delete?')) {
                                                            event.preventDefault();
                                                            document.getElementById('form-delete-{{$overdueProject->id}}').submit();
                                                            }else{
                                                            event.preventDefault();
                                                            }

                                                            "><i class="fa fa-fw fa-trash"></i></a>

                                                </div>
                                            </td>
                                            <td>{{$overdueProject->title}}</td>
                                            <td>{!! statusColor($overdueProject->status) !!}</td>
                                            <td>{!! calculateProgress($overdueProject->slug) !!}</td>
                                            <td>{{$overdueProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{!! '<small>'.$overdueProject->due_date->format(config('constants.time.format')).'</small> '. dueDays($overdueProject->due_date)  !!}</td>
                                            <td>{{$overdueProject->partner->name}}</td>
                                            <td>
                                                @if(!empty($overdueProject->user_id))
                                                    {{$overdueProject->pm->name}}
                                                @else
                                                    No PM Assigned
                                                @endif</td>


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
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="completed">

                            @if ($completedProjects->isNotEmpty())

                                <table id="example4" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Progress</th>
                                        <th>Start date</th>
                                        <th>Due date</th>
                                        <th>Partner</th>
                                        <th>Assigned PM</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($completedProjects as $completedProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    {{--<a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-xs btn-default"--}}
                                                    {{--href="{{route('admin-project-assign.show',$project->id)}}"><i--}}
                                                    {{--class="fa fa-fw fa-arrow-circle-right"></i></a>--}}
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{route('admin-project-assign.edit',$completedProject->id)}}"><i
                                                                class="fa fa-fw fa-edit"></i></a>

                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                       title="Snap Shot"
                                                       data-slug="{{$completedProject->slug}}"
                                                       data-title="{{$completedProject->title}}"
                                                       data-source="{{route('snap.shot')}}"
                                                       class="open-snap btn btn-default btn-xs"> <i
                                                                class="fa fa-fw fa-camera"></i></a>

                                                    <a href="{{route('expense.export',$completedProject->slug)}}"
                                                       data-toggle="tooltip" data-placement="top" title="Expense Report"
                                                       class="btn btn-default btn-xs"> <i
                                                                class="fa fa-fw fa-file"></i></a>

                                                    <form id="form-delete-{{$completedProject->id}}" method="post"
                                                          action="{{route('admin-project-assign.destroy',$completedProject->id)}}"
                                                          style="display: none;">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}

                                                    </form>

                                                    <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                       class="btn btn-xs btn-danger" href="#" onclick="

                                                            if(confirm('Are you sure want to Delete?')) {
                                                            event.preventDefault();
                                                            document.getElementById('form-delete-{{$completedProject->id}}').submit();
                                                            }else{
                                                            event.preventDefault();
                                                            }

                                                            "><i class="fa fa-fw fa-trash"></i></a>
                                                </div>
                                            </td>
                                            <td>{{$completedProject->title}}</td>
                                            <td>{!! statusColor($completedProject->status) !!}</td>
                                            <td>{!! calculateProgress($completedProject->slug) !!}</td>
                                            <td>{{$completedProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$completedProject->due_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$completedProject->partner->name}}</td>
                                            <td>{{$completedProject->pm->name}}</td>


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
                                        <th>Progress</th>
                                        <th>Start date</th>
                                        <th>Due date</th>
                                        <th>Partner</th>
                                        <th>Assigned PM</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allProjects as $allProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    {{--<a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-xs btn-default"--}}
                                                    {{--href="{{route('admin-project-assign.show',$project->id)}}"><i--}}
                                                    {{--class="fa fa-fw fa-arrow-circle-right"></i></a>--}}
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{route('admin-project-assign.edit',$allProject->id)}}"><i
                                                                class="fa fa-fw fa-edit"></i></a>

                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                       title="Snap Shot"
                                                       data-slug="{{$allProject->slug}}"
                                                       data-title="{{$allProject->title}}"
                                                       data-source="{{route('snap.shot')}}"
                                                       class="open-snap btn btn-default btn-xs"> <i
                                                                class="fa fa-fw fa-camera"></i></a>

                                                    <a href="{{route('expense.export',$allProject->slug)}}"
                                                       data-toggle="tooltip" data-placement="top" title="Expense Report"
                                                       class="btn btn-default btn-xs"> <i
                                                                class="fa fa-fw fa-file"></i></a>

                                                    <form id="form-delete-{{$allProject->id}}" method="post"
                                                          action="{{route('admin-project-assign.destroy',$allProject->id)}}"
                                                          style="display: none;">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}

                                                    </form>

                                                    <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                       class="btn btn-xs btn-danger" href="#" onclick="

                                                            if(confirm('Are you sure want to Delete?')) {
                                                            event.preventDefault();
                                                            document.getElementById('form-delete-{{$allProject->id}}').submit();
                                                            }else{
                                                            event.preventDefault();
                                                            }

                                                            "><i class="fa fa-fw fa-trash"></i></a>
                                                </div>
                                            </td>
                                            <td>{{$allProject->title}}</td>
                                            <td>{!! statusColor($allProject->status) !!}</td>
                                            <td>{!! calculateProgress($allProject->slug) !!}</td>
                                            <td>{{$allProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$allProject->due_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$allProject->partner->name}}</td>
                                            <td>
                                                @if(!empty($allProject->user_id))
                                                    {{$allProject->pm->name}}
                                                @else
                                                    No PM Assigned
                                                @endif</td>


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



                <div class="modal fade" id="snapModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="title"></h4>
                            </div>
                            <div class="modal-body">
                                <div id="snap-data"></div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">Close
                                </button>

                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->



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
            $('#example1,#example2,#example3,#example4,#example5').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                "order": [[0, "desc"]]
            });

        })

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.open-snap', function () {
                var t = $(this);
                $('#snapModal').modal('show');

                var title = $(t).attr("data-title") + " Snap Shot";

                $('#title').text(title);

                var data = {

                    'slug': $(t).attr("data-slug")
                };


                $.ajax({
                    url: $(t).attr("data-source"),
                    data: data,
                    dataType: 'json',
                    type: "post",
                    success: function (data) {

                        if (data.success == true) {

                            $('#snap-data').html(data.html);

                            var table = $('#snapshot').DataTable({
                                'paging': true,
                                'lengthChange': false,
                                'searching': false,
                                'info': true,
                                'autoWidth': false,

                                "order": [],
                                "columnDefs": [{
                                    "targets": 'no-sort',
                                    "orderable": false,
                                }]

                            });


                        } else {
                            alert("Error Processing...!");
                        }


                    }
                })
            });

        });
    </script>

@endsection