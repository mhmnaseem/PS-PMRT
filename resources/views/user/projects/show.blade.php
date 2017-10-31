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

                {{str_limit($project->title,100)}}

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Project Details</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">


            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">
                            <i class="fa fa-home"></i> Detail </a>
                    </li>
                    <li><a href="#pd" data-toggle="tab">
                            <i class="fa fa-bullseye" aria-hidden="true"></i> P&D</a>
                    </li>
                    <li><a href="#network-assessment" data-toggle="tab">
                            <i class="fa fa-quote-right" aria-hidden="true"></i> Probe/ Network Assessment</a>
                    </li>
                    <li><a href="#admin-training" data-toggle="tab">
                            <i class="fa fa-book" aria-hidden="true"></i> Admin Training </a>
                    </li>
                    <li><a href="#back-end-build-out" data-toggle="tab">
                            <i class="fa fa-shield" aria-hidden="true"></i> Back end Build Out </a>
                    </li>
                    <li><a href="#number-porting" data-toggle="tab">
                            <i class="fa fa-server" aria-hidden="true"></i> Number Porting </a>
                    </li>
                    <li><a href="#onsite-delivery-go-live" data-toggle="tab">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Onsite delivery/Go Live </a>
                    </li>
                    <li><a href="#notes" data-toggle="tab">
                            <i class="fa fa-pencil" aria-hidden="true"></i> Notes</a>
                    </li>
                    <li><a href="#attachments" data-toggle="tab">
                            <i class="fa fa-paperclip" aria-hidden="true"></i> Attachments</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="home">

                        <div class="row">
                            <div class="col-sm-8">

                                <h3>Project Description</h3>
                                <hr>


                                {!! htmlspecialchars_decode($project->description) !!}


                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <div class="btn-group">

                                            <a data-toggle="tooltip" data-placement="top" title="Edit"
                                               class="btn btn-xs btn-info"
                                               href="{{route('projects.edit',$project->slug)}}"><i
                                                        class="fa fa-fw fa-2x fa-edit" aria-hidden="true"></i></a>
                                            @if($project->star==0)
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                   title="Add to Star" data-slug="{{$project->slug}}" data-value="1"
                                                   data-source="{{route('star')}}" class="ajax btn btn-default btn-xs">
                                                    <i
                                                            class="fa fa-fw fa-2x fa-star-o"></i></a>
                                            @else
                                                <a href="#" data-toggle="tooltip" data-placement="top"
                                                   title="Remove from Star" data-slug="{{$project->slug}}"
                                                   data-value="0" data-source="{{route('star')}}"
                                                   class="ajax btn btn-default btn-xs"> <i
                                                            class="fa fa-fw fa-2x fa-star"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <strong><i class="fa fa-check-circle text-maroon margin-r-5"></i>
                                            Status</strong>

                                        <p>
                                            {!! statusColor($project->status) !!}
                                        </p>

                                        <hr>

                                        <strong><i class="fa fa-calendar text-maroon margin-r-5"></i> Start
                                            Date</strong>

                                        <p class="text-muted">{{$project->start_date->format(config('constants.time.format'))}}</p>

                                        <hr>

                                        <strong><i class="fa fa-calendar text-maroon margin-r-5"></i> Due Date</strong>

                                        <p class="text-muted">
                                            @if ($project->due_date < Carbon\Carbon::now())
                                                {!!'<small>'.$project->due_date->format(config('constants.time.format')).'</small> '. dueDays($project->due_date)!!}
                                            @else
                                                {{$project->due_date->format(config('constants.time.format'))}}
                                            @endif
                                        </p>

                                        <hr>

                                        <strong><i class="fa fa-file-text-o text-maroon margin-r-5"></i> Notes</strong>


                                        <textarea disabled class="notes">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neasdasd
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neasdasd
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neasdasd
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neasdasd
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neasdasd
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neasdasd
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neasdasd

                                        </textarea>

                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                        {{--@if ($starProjects->isNotEmpty())--}}

                        {{--<table id="example1" class="table table-bordered table-striped">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                        {{--<th>Option</th>--}}
                        {{--<th>Title</th>--}}
                        {{--<th>Status</th>--}}
                        {{--<th>Start date</th>--}}
                        {{--<th>Due date</th>--}}



                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--@foreach($starProjects as $starProject)--}}
                        {{--<tr>--}}
                        {{--<td>--}}
                        {{--<div class="btn-group">--}}

                        {{--<a data-toggle="tooltip" data-placement="top" title="Edit"--}}
                        {{--class="btn btn-xs btn-success"--}}
                        {{--href="{{route('projects.show',$starProject->slug)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>--}}
                        {{--@if($starProject->star==0)--}}
                        {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Star" data-slug="{{$starProject->slug}}" data-value="1"--}}
                        {{--data-source="{{route('star')}}" class="ajax btn btn-default btn-xs"> <i--}}
                        {{--class="fa fa-fw fa-star-o"></i></a>--}}
                        {{--@else--}}
                        {{--<a href="#" data-toggle="tooltip" data-placement="top" title="Remove from Star" data-slug="{{$starProject->slug}}" data-value="0" data-source="{{route('star')}}"--}}
                        {{--class="ajax btn btn-default btn-xs"> <i class="fa fa-fw fa-star"></i></a>--}}
                        {{--@endif--}}
                        {{--</div>--}}
                        {{--</td>--}}
                        {{--<td>{{$starProject->title}}</td>--}}
                        {{--<td>{!! statusColor($starProject->status) !!}</td>--}}
                        {{--<td>{{$starProject->start_date->format(config('constants.time.format'))}}</td>--}}
                        {{--<td>{{$starProject->due_date->format(config('constants.time.format'))}}</td>--}}

                        {{--</tr>--}}

                        {{--@endforeach--}}
                        {{--</table>--}}
                        {{--@else--}}

                        {{--<div class="callout callout-info">--}}
                        {{--<h4> No Stars Projects !</h4>--}}

                        {{--<p>Please Check Back Later..!</p>--}}
                        {{--</div>--}}

                        {{--@endif--}}


                    </div>

                    <div class="tab-pane" id="pd">

                        {{--@if ()--}}

                        {{--@else--}}

                        {{--<div class="callout callout-info">--}}
                        {{--<h4> No Pending Projects !</h4>--}}

                        {{--<p>Please Check Back Later..!</p>--}}
                        {{--</div>--}}

                        {{--@endif--}}


                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="network-assessment">

                        {{--@if ()--}}

                        {{--@else--}}

                        {{--<div class="callout callout-info">--}}
                        {{--<h4>No Overdue Projects !</h4>--}}

                        {{--<p>Please Check Back Later..!</p>--}}
                        {{--</div>--}}

                        {{--@endif--}}
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="admin-training">

                        {{--@if ()--}}


                        {{--@else--}}

                        {{--<div class="callout callout-info">--}}
                        {{--<h4> No Completed Projects !</h4>--}}

                        {{--<p>Please Check Back Later..!</p>--}}
                        {{--</div>--}}

                        {{--@endif--}}
                    </div>
                    <!-- /.tab-pane -->

                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="back-end-build-out">

                        {{--@if ()--}}


                        {{--@else--}}

                        {{--<div class="callout callout-info">--}}
                        {{--<h4> No Projects !</h4>--}}

                        {{--<p>Please Check Back Later..!</p>--}}
                        {{--</div>--}}

                        {{--@endif--}}
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="number-porting">

                        {{--@if ()--}}


                        {{--@else--}}

                        {{--<div class="callout callout-info">--}}
                        {{--<h4> No Projects !</h4>--}}

                        {{--<p>Please Check Back Later..!</p>--}}
                        {{--</div>--}}

                        {{--@endif--}}
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="onsite-delivery-go-live">

                        {{--@if ()--}}


                        {{--@else--}}

                        {{--<div class="callout callout-info">--}}
                        {{--<h4> No Projects !</h4>--}}

                        {{--<p>Please Check Back Later..!</p>--}}
                        {{--</div>--}}

                        {{--@endif--}}
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="notes">

                        {{--@if ()--}}


                        {{--@else--}}

                        {{--<div class="callout callout-info">--}}
                        {{--<h4> No Projects !</h4>--}}

                        {{--<p>Please Check Back Later..!</p>--}}
                        {{--</div>--}}

                        {{--@endif--}}
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="attachments">

                        {{--@if ()--}}


                        {{--@else--}}

                        {{--<div class="callout callout-info">--}}
                        {{--<h4> No Projects !</h4>--}}

                        {{--<p>Please Check Back Later..!</p>--}}
                        {{--</div>--}}

                        {{--@endif--}}
                    </div>
                    <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

@section('footer')
    <script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>
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


//        $(function () {
//
//            CKEDITOR.replace('editor1');
//        });


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