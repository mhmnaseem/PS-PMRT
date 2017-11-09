@extends('user.layout.master')

@section ('header')

    <link rel="stylesheet"
          href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet"
          href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">

@endsection

@section('title', 'All Projects')

@section ('main-content')



    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                All Projects

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Projects</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

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
                            Completed Projects <span class="badge">{{$total['totalCompleted']}}</span></a></li>
                    <li><a href="#all" data-toggle="tab">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                            All Projects <span class="badge">{{$total['allProjects']}}</span></a></li>

                    <li><a href="#assigned" data-toggle="tab">
                            <i class="fa fa-random" aria-hidden="true"></i> Assigned Projects <span
                                    class="badge">{{$total['totalAssigned']}}</span></a>
                    </li>

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
                                    <th>Progress</th>
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
                                                   href="{{route('projects.show',$pendingProject->slug)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>

                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Snap Shot"
                                                   data-slug="{{$pendingProject->slug}}" data-title="{{$pendingProject->title}}"
                                                   data-source="{{route('snap.shot')}}"
                                                   class="open-snap btn btn-default btn-xs"> <i
                                                            class="fa fa-fw fa-camera"></i></a>
                                                {{--@if($pendingProject->star==0)--}}
                                                {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Star" data-slug="{{$pendingProject->slug}}" data-value="1"--}}
                                                {{--data-source="{{route('star')}}" class="ajax btn btn-default btn-xs"> <i--}}
                                                {{--class="fa fa-fw fa-star-o"></i></a>--}}
                                                {{--@else--}}
                                                {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Remove from Star" data-slug="{{$pendingProject->slug}}" data-value="0" data-source="{{route('star')}}"--}}
                                                {{--class="ajax btn btn-default btn-xs"> <i class="fa fa-fw fa-star"></i></a>--}}
                                                {{--@endif--}}
                                            </div>
                                        </td>
                                        <td>{{$pendingProject->title}}</td>
                                        <td>{!! statusColor($pendingProject->status) !!}</td>
                                        <td>{!! calculateProgress($pendingProject->slug) !!}</td>
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


                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Progress</th>
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
                                                   href="{{route('projects.show',$overdueProject->slug)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>

                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Snap Shot"
                                                   data-slug="{{$overdueProject->slug}}" data-title="{{$overdueProject->title}}"
                                                   data-source="{{route('snap.shot')}}"
                                                   class="open-snap btn btn-default btn-xs"> <i
                                                            class="fa fa-fw fa-camera"></i></a>

                                                {{--@if($overdueProject->star==0)--}}
                                                {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Star" data-slug="{{$overdueProject->slug}}" data-value="1"--}}
                                                {{--data-source="{{route('star')}}" class="ajax btn btn-default btn-xs"> <i--}}
                                                {{--class="fa fa-fw fa-star-o"></i></a>--}}
                                                {{--@else--}}
                                                {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Remove from Star" data-slug="{{$overdueProject->slug}}" data-value="0" data-source="{{route('star')}}"--}}
                                                {{--class="ajax btn btn-default btn-xs"> <i class="fa fa-fw fa-star"></i></a>--}}
                                                {{--@endif--}}
                                            </div>
                                        </td>
                                        <td>{{$overdueProject->title}}</td>
                                        <td>{!! statusColor($overdueProject->status) !!}</td>
                                        <td>{!! calculateProgress($overdueProject->slug) !!}</td>
                                        <td>{{$overdueProject->start_date->format(config('constants.time.format'))}}</td>
                                        <td>{!! '<small>'.$overdueProject->due_date->format(config('constants.time.format')).'</small> '. dueDays($overdueProject->due_date)  !!}</td>


                                    </tr>
                                @endforeach
                                </tbody>
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

                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                    <th>Start date</th>
                                    <th>Due date</th>
                                    <th>Complete date</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($completedProjects as $completedProject)
                                    <tr>
                                        <td>
                                            <div class="btn-group">

                                                <a data-toggle="tooltip" data-placement="top" title="View & Edit"
                                                   class="btn btn-xs btn-success"
                                                   href="{{route('projects.show',$completedProject->slug)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>

                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Snap Shot"
                                                   data-slug="{{$completedProject->slug}}" data-title="{{$completedProject->title}}"
                                                   data-source="{{route('snap.shot')}}"
                                                   class="open-snap btn btn-default btn-xs"> <i
                                                            class="fa fa-fw fa-camera"></i></a>

                                                {{--@if($completedProject->star==0)--}}
                                                {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Star" data-slug="{{$completedProject->slug}}" data-value="1"--}}
                                                {{--data-source="{{route('star')}}" class="ajax btn btn-default btn-xs"> <i--}}
                                                {{--class="fa fa-fw fa-star-o"></i></a>--}}
                                                {{--@else--}}
                                                {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Remove from Star" data-slug="{{$completedProject->slug}}" data-value="0" data-source="{{route('star')}}"--}}
                                                {{--class="ajax btn btn-default btn-xs"> <i class="fa fa-fw fa-star"></i></a>--}}
                                                {{--@endif--}}
                                            </div>
                                        </td>
                                        <td>{{$completedProject->title}}</td>
                                        <td>{!! statusColor($completedProject->status) !!}</td>
                                        <td>{!! calculateProgress($completedProject->slug) !!}</td>
                                        <td>{{$completedProject->start_date->format(config('constants.time.format'))}}</td>
                                        <td>{{$completedProject->due_date->format(config('constants.time.format'))}}</td>
                                        <td>
                                            @if($completedProject->complete_date != null)
                                                {{$completedProject->complete_date->format(config('constants.time.format'))}}
                                            @else
                                                Not Complete yet
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach
                                </tbody>
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
                                    <th>Progress</th>
                                    <th>Start date</th>
                                    <th>Due date</th>
                                    <th>Complete date</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allProjects as $allProject)
                                    <tr>
                                        <td>
                                            <div class="btn-group">

                                                <a data-toggle="tooltip" data-placement="top" title="View & Edit"
                                                   class="btn btn-xs btn-success"
                                                   href="{{route('projects.show',$allProject->slug)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>

                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Snap Shot"
                                                   data-slug="{{$allProject->slug}}" data-title="{{$allProject->title}}"
                                                   data-source="{{route('snap.shot')}}"
                                                   class="open-snap btn btn-default btn-xs"> <i
                                                            class="fa fa-fw fa-camera"></i></a>

                                                {{--@if($allProject->star==0)--}}
                                                {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Star" data-slug="{{$allProject->slug}}" data-value="1"--}}
                                                {{--data-source="{{route('star')}}" class="ajax btn btn-default btn-xs"> <i--}}
                                                {{--class="fa fa-fw fa-star-o"></i></a>--}}
                                                {{--@else--}}
                                                {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Remove from Star" data-slug="{{$allProject->slug}}" data-value="0" data-source="{{route('star')}}"--}}
                                                {{--class="ajax btn btn-default btn-xs"> <i class="fa fa-fw fa-star"></i></a>--}}
                                                {{--@endif--}}
                                            </div>
                                        </td>
                                        <td>{{$allProject->title}}</td>
                                        <td>{!! statusColor($allProject->status) !!}</td>
                                        <td>{!! calculateProgress($allProject->slug) !!}</td>
                                        <td>{{$allProject->start_date->format(config('constants.time.format'))}}</td>
                                        <td>{{$allProject->due_date->format(config('constants.time.format'))}}</td>
                                        <td>
                                            @if($allProject->complete_date != null)
                                                {{$allProject->complete_date->format(config('constants.time.format'))}}
                                            @else
                                                Not Complete yet
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No Projects !</h4>

                                <p>Please Check Back Later..!</p>
                            </div>

                        @endif
                    </div>


                    <div class="tab-pane" id="assigned">

                        @if ($assignedProjects->isNotEmpty())


                            <table id="example5" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                    <th>Start date</th>
                                    <th>Due date</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assignedProjects as $assignedProject)
                                    <tr>
                                        <td>
                                            <div class="btn-group">

                                                <a data-toggle="tooltip" data-placement="top" title="View & Edit"
                                                   class="btn btn-xs btn-success"
                                                   href="{{route('projects.show',$assignedProject->slug)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>

                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Snap Shot"
                                                   data-slug="{{$assignedProject->slug}}" data-title="{{$assignedProject->title}}"
                                                   data-source="{{route('snap.shot')}}"
                                                   class="open-snap btn btn-default btn-xs"> <i
                                                            class="fa fa-fw fa-camera"></i></a>
                                            </div>
                                        </td>
                                        <td>{{$assignedProject->title}}</td>
                                        <td>{!! statusColor($assignedProject->status) !!}</td>
                                        <td>{!! calculateProgress($assignedProject->slug) !!}</td>
                                        <td>{{$assignedProject->start_date->format(config('constants.time.format'))}}</td>
                                        <td>{{$assignedProject->due_date->format(config('constants.time.format'))}}</td>



                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @else

                            <div class="callout callout-info">
                                <h4>No Project Assigned !</h4>

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


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

@section('footer')

    <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
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


            $(document).on('click', '.open-snap', function () {
                var t = $(this);
                $('#snapModal').modal('show');

                var title= $(t).attr("data-title")+ " Snap Shot";

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
                            var buttons = new $.fn.dataTable.Buttons(table, {
                                buttons: [

                                    {extend: 'pdf', className: 'btn btn-default', title: 'Data export'},
                                    {extend: 'copy', className: 'btn btn-default', title: 'Data export'}

                                ],
                            }).container().appendTo($('#buttons'));

                        } else {
                            alert("Error Processing...!");
                        }


                    }
                })
            });
        });


    </script>

@endsection