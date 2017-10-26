@extends('partner.layout.master')

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
                                <i class="fa fa-hourglass-half" aria-hidden="true"></i> Un Assigned
                                <span class="badge">{{$total['totalPending']}}</span></a>
                        </li>
                        <li><a href="#assigned" data-toggle="tab">
                                <i class="fa fa-random" aria-hidden="true"></i> Assigned <span
                                        class="badge">{{$total['totalAssigned']}}</span></a>
                        </li>
                        <li><a href="#completed" data-toggle="tab">
                                <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                Completed <span class="badge">{{$total['totalCompleted']}}</span></a></li>
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
                                        <th>Assign To PM</th>


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
                                            <td>
                                                <button value="{{$pendingProject->slug}}"
                                                        class="btn btn-xs btn-success open_modal">
                                                    <i class="fa fa-fw fa-link"></i></button>
                                            </td>
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


                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Start date</th>
                                        <th>Due date</th>
                                        <th>Assigned PM</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($assignedProjects as $assignedProject)
                                        <tr>
                                            <td>
                                                <div class="btn-group">

                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{route('partner-project-assign.edit',$assignedProject->slug)}}"><i
                                                                class="fa fa-fw fa-edit"></i></a>

                                                </div>
                                            </td>
                                            <td>{{$assignedProject->title}}</td>
                                            <td>{!! statusColor($assignedProject->status) !!}</td>
                                            <td>{{$assignedProject->start_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$assignedProject->due_date->format(config('constants.time.format'))}}</td>
                                            <td>{{$assignedProject->pm->name}}</td>


                                        </tr>
                                    @endforeach
                                </table>

                            @else

                                <div class="callout callout-info">
                                    <h4>No Project Assigned to your Account !</h4>

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
                                        s
                                        <th>Status</th>
                                        <th>Start date</th>
                                        <th>Due date</th>
                                        <th>Assigned PM</th>


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

                                <table id="example4" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Start date</th>
                                        <th>Due date</th>
                                        <th>Assigned PM</th>


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
                                            <td>
                                                @if(!empty($allProject->user_id))
                                                    {{$allProject->pm->name}}
                                                @else

                                                    <button value="{{$allProject->slug}}"
                                                            class="btn btn-xs btn-success open_modal">
                                                        <i class="fa fa-fw fa-link"></i></button>  @endif</td>


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


                <div class="modal fade" id="myModal">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Assign Project Manager</h4>
                            </div>
                            <div class="modal-body">
                                <form id="assign-form" role="form" method="post"
                                      action="{{route('pm-project-assign.assign')}}">

                                    <input type="hidden" id="slug" name="slug">

                                    <div class="form-group">
                                        <label for="project_manager" class="control-label">Project
                                            Manager</label>

                                        <select name="pm" id="pm" class="form-control"
                                                name="project_manager" autofocus>
                                            @foreach($pms as $pm)
                                                <option value="{{ $pm->id }}">{{ $pm->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <button id="btn-assign" type="submit" class="btn btn-success">
                                        Assign PM
                                    </button>
                                </form>
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
        });


        //Assign PM
        $(document).ready(function () {
            $(document).on('click', '.open_modal', function () {

                $('#myModal').modal('show');
                $('#slug').val($(this).val());

            });


            $("#btn-assign").click(function (e) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })
                e.preventDefault();
                var formData = {
                    pm: $('#pm').val(),
                    slug: $('#slug').val()
                }
                var url = $('#assign-form').attr('action');

                //console.log(formData);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data);

                        if (data == "true") { //if user added a new record
                            $('#myModal').modal('hide')
                            location.reload();
                        }

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });


        });

        $(function () {
            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });
        });



    </script>

@endsection