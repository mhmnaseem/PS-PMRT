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
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>

                    </div>
                </div>


                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-hourglass-half"
                                                                                 aria-hidden="true"></i> Un Assigned</a>
                        </li>
                        <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-random" aria-hidden="true"></i> Assigned</a>
                        </li>
                        <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-handshake-o" aria-hidden="true"></i>
                                Completed</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
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
                                @foreach($projects as $project)
                                    <tr>
                                        <td>
                                            <div class="btn-group">

                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{route('partner-project-assign.edit',$project->slug)}}"><i
                                                            class="fa fa-fw fa-edit"></i></a>

                                            </div>
                                        </td>
                                        <td>{{$project->title}}</td>
                                        <td>{!! statusColor($project->status) !!}</td>
                                        <td>{{$project->start_date->format(config('constants.time.format'))}}</td>
                                        <td>{{$project->due_date->format(config('constants.time.format'))}}</td>
                                        <td><a data-toggle="tooltip" data-placement="top" title="Assign to PM"
                                               class="btn btn-xs btn-success"
                                               href="{{route('partner-project-assign.edit',$project->slug)}}"><i
                                                        class="fa fa-fw fa-link"></i></a></td>


                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            The European languages are members of the same family. Their separate existence is a myth.
                            For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                            in their grammar, their pronunciation and their most common words. Everyone realizes why a
                            new common language would be desirable: one could refuse to pay expensive translators. To
                            achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                            words. If several languages coalesce, the grammar of the resulting language is more simple
                            and regular than that of the individual languages.
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            It has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially unchanged. It was popularised in the 1960s with the release of
                            Letraset
                            sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                            like Aldus PageMaker including versions of Lorem Ipsum.
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
                'autoWidth': false
                "order": [[0, "desc"]]
            })
        })

        $(function () {
            $('#tab_2 a').click(function (e) {
                e.preventDefault();
                $('a[href="' + $(this).attr('href') + '"]').tab('show');
            })
        });

    </script>

@endsection