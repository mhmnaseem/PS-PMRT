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
                            <i class="fa fa-home text-success"></i> Detail </a>
                    </li>
                    <li><a href="#pd" data-toggle="tab">
                            <i class="fa fa-bullseye text-aqua" aria-hidden="true"></i> P&D</a>
                    </li>
                    <li><a href="#network-assessment" data-toggle="tab">
                            <i class="fa fa-file-text text-maroon " aria-hidden="true"></i> Probe/ Network Assessment</a>
                    </li>
                    <li><a href="#admin-training" data-toggle="tab">
                            <i class="fa fa-book text-olive" aria-hidden="true"></i> Admin Training </a>
                    </li>
                    <li><a href="#back-end-build-out" data-toggle="tab">
                            <i class="fa fa-shield text-fuchsia" aria-hidden="true"></i> Back End Build Out </a>
                    </li>
                    <li><a href="#number-porting" data-toggle="tab">
                            <i class="fa fa-server text-orange" aria-hidden="true"></i> Number Porting </a>
                    </li>
                    <li><a href="#onsite-delivery-go-live" data-toggle="tab">
                            <i class="fa fa-shopping-cart text-light-blue" aria-hidden="true"></i> Onsite Delivery/Go Live </a>
                    </li>
                    <li><a href="#notes" data-toggle="tab">
                            <i class="fa fa-pencil text-yellow" aria-hidden="true"></i> Notes</a>
                    </li>
                    <li><a href="#attachments" data-toggle="tab">
                            <i class="fa fa-paperclip text-red" aria-hidden="true"></i> Attachments</a>
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

                                        <strong><i class="fa fa-spinner text-maroon margin-r-5"></i>
                                            Progress</strong>

                                        <p>
                                            {!! calculateProgress($project->slug) !!}
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


                                        <textarea disabled class="notes">@if($project->projectNote !=null ){{$project->projectNote->note}}@endif</textarea>

                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->



                    </div>

                    <div class="tab-pane" id="pd">




                        <h3><span>P&D</span>
                            <a data-toggle="tooltip" data-placement="top" title="Add New"
                               class="pull-right btn btn-xs btn-default"
                               href="{{route('projects.pd.create',$project->slug)}}"><i
                                        class="fa fa-fw text-olive fa-2x fa-plus" aria-hidden="true"></i></a>
                        </h3>
                        <hr>

                        @if ($project->ProjectPd->isNotEmpty())

                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Status</th>
                                    <th>date</th>
                                    <th>Comment</th>





                                </tr>
                                </thead>
                                <tbody>
                                @foreach($project->projectPd as $pd)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <a data-toggle="tooltip" data-placement="top" title="View"
                                                   class="btn btn-xs btn-success"
                                                   href="{{url('pm/projects/'.$project->slug.'/pd/'.$pd->id)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/pd/'.$pd->id.'/edit')}}"><i class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
                                                <form id="form-delete-pd{{$pd->id}}" method="post"
                                                      action="{{url('pm/projects/'.$project->slug.'/pd/'.$pd->id)}}"
                                                      style="display: none;">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}

                                                </form>

                                                <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                   class="btn btn-xs btn-danger" href="#" onclick="

                                                        if(confirm('Are you sure want to Delete?')) {
                                                        event.preventDefault();
                                                        document.getElementById('form-delete-pd{{$pd->id}}').submit();
                                                        }else{
                                                        event.preventDefault();
                                                        }

                                                        "><i class="fa fa-fw fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <td>{!! statusColor($pd->status) !!}</td>
                                        <td>{{$pd->date->format(config('constants.time.format'))}}</td>
                                        <td>
                                        {!! htmlspecialchars_decode(str_limit($pd->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No P&D For this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif


                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="network-assessment">

                        <h3><span>Probe/ Network Assessment</span>
                            <a data-toggle="tooltip" data-placement="top" title="Add New"
                               class="pull-right btn btn-xs btn-default"
                               href="{{route('projects.network-assessment.create',$project->slug)}}"><i
                                        class="fa fa-fw text-olive fa-2x fa-plus" aria-hidden="true"></i></a>
                        </h3>
                        <hr>

                        @if ($project->projectNetworkAssessment->isNotEmpty())

                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Status</th>
                                    <th>date</th>
                                    <th>Comment</th>





                                </tr>
                                </thead>
                                <tbody>
                                @foreach($project->projectNetworkAssessment as $networkAssessment)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <a data-toggle="tooltip" data-placement="top" title="View"
                                                   class="btn btn-xs btn-success"
                                                   href="{{url('pm/projects/'.$project->slug.'/network-assessment/'.$networkAssessment->id)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/network-assessment/'.$networkAssessment->id.'/edit')}}"><i class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
                                                <form id="form-delete-network{{$networkAssessment->id}}" method="post"
                                                      action="{{url('pm/projects/'.$project->slug.'/network-assessment/'.$networkAssessment->id)}}"
                                                      style="display: none;">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}

                                                </form>

                                                <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                   class="btn btn-xs btn-danger" href="#" onclick="

                                                        if(confirm('Are you sure want to Delete?')) {
                                                        event.preventDefault();
                                                        document.getElementById('form-delete-network{{$networkAssessment->id}}').submit();
                                                        }else{
                                                        event.preventDefault();
                                                        }

                                                        "><i class="fa fa-fw fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <td>{!! statusColor($networkAssessment->status) !!}</td>
                                        <td>{{$networkAssessment->date->format(config('constants.time.format'))}}</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($networkAssessment->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No Probe/ Network Assessment for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="admin-training">

                        <h3><span>Admin Training</span>
                            <a data-toggle="tooltip" data-placement="top" title="Add New"
                               class="pull-right btn btn-xs btn-default"
                               href="{{route('projects.admin-training.create',$project->slug)}}">
                                <i class="fa fa-fw text-olive fa-2x fa-plus" aria-hidden="true"></i></a>
                        </h3>
                        <hr>

                        @if ($project->projectAdminTraining->isNotEmpty())

                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>date</th>
                                    <th>Comment</th>





                                </tr>
                                </thead>
                                <tbody>
                                @foreach($project->projectAdminTraining as $adminTraining)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <a data-toggle="tooltip" data-placement="top" title="View"
                                                   class="btn btn-xs btn-success"
                                                   href="{{url('pm/projects/'.$project->slug.'/admin-training/'.$adminTraining->id)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/admin-training/'.$adminTraining->id.'/edit')}}"><i class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
                                                <form id="form-delete-admin{{$adminTraining->id}}" method="post"
                                                      action="{{url('pm/projects/'.$project->slug.'/admin-training/'.$adminTraining->id)}}"
                                                      style="display: none;">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}

                                                </form>

                                                <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                   class="btn btn-xs btn-danger" href="#" onclick="

                                                        if(confirm('Are you sure want to Delete?')) {
                                                        event.preventDefault();
                                                        document.getElementById('form-delete-admin{{$adminTraining->id}}').submit();
                                                        }else{
                                                        event.preventDefault();
                                                        }

                                                        "><i class="fa fa-fw fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <td>{{$adminTraining->title}}</td>
                                        <td>{!! statusColor($adminTraining->status) !!}</td>
                                        <td>@if($adminTraining->date!="")
                                                {{$adminTraining->date->format(config('constants.time.format'))}}
                                            @endif</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($adminTraining->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No Admin Training for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif
                    </div>
                    <!-- /.tab-pane -->

                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="back-end-build-out">

                        <h3><span>Back End Build Out</span>
                            <a data-toggle="tooltip" data-placement="top" title="Add New"
                               class="pull-right btn btn-xs btn-default"
                               href="{{route('projects.back-end-build-out.create',$project->slug)}}">
                                <i class="fa fa-fw text-olive fa-2x fa-plus" aria-hidden="true"></i></a>
                        </h3>
                        <hr>

                        @if ($project->projectBackEndBuildOut->isNotEmpty())

                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>User Upload</th>
                                    <th>Call Flows</th>
                                    <th>Comment</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($project->projectBackEndBuildOut as $backEndBuildOut)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <a data-toggle="tooltip" data-placement="top" title="View"
                                                   class="btn btn-xs btn-success"
                                                   href="{{url('pm/projects/'.$project->slug.'/back-end-build-out/'.$backEndBuildOut->id)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/back-end-build-out/'.$backEndBuildOut->id.'/edit')}}"><i class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
                                                <form id="form-delete-back{{$backEndBuildOut->id}}" method="post"
                                                      action="{{url('pm/projects/'.$project->slug.'/back-end-build-out/'.$backEndBuildOut->id)}}"
                                                      style="display: none;">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}

                                                </form>

                                                <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                   class="btn btn-xs btn-danger" href="#" onclick="

                                                        if(confirm('Are you sure want to Delete?')) {
                                                        event.preventDefault();
                                                        document.getElementById('form-delete-back{{$backEndBuildOut->id}}').submit();
                                                        }else{
                                                        event.preventDefault();
                                                        }

                                                        "><i class="fa fa-fw fa-trash"></i></a>
                                            </div>
                                        </td>

                                        <td>{!! statusColor($backEndBuildOut->user_upload) !!}</td>
                                        <td>{!! statusColor($backEndBuildOut->call_flows) !!}</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($backEndBuildOut->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No Back End Build Out for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="number-porting">

                        <h3><span>Number Porting</span>
                            <a data-toggle="tooltip" data-placement="top" title="Add New"
                               class="pull-right btn btn-xs btn-default"
                               href="{{route('projects.number-porting.create',$project->slug)}}">
                                <i class="fa fa-fw text-olive fa-2x fa-plus" aria-hidden="true"></i></a>
                        </h3>
                        <hr>

                        @if ($project->projectNumberPorting->isNotEmpty())

                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Port Date</th>
                                    <th>Comment</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($project->projectNumberPorting as $numberPorting)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <a data-toggle="tooltip" data-placement="top" title="View"
                                                   class="btn btn-xs btn-success"
                                                   href="{{url('pm/projects/'.$project->slug.'/number-porting/'.$numberPorting->id)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/number-porting/'.$numberPorting->id.'/edit')}}"><i class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
                                                <form id="form-delete-number{{$numberPorting->id}}" method="post"
                                                      action="{{url('pm/projects/'.$project->slug.'/number-porting/'.$numberPorting->id)}}"
                                                      style="display: none;">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}

                                                </form>

                                                <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                   class="btn btn-xs btn-danger" href="#" onclick="

                                                        if(confirm('Are you sure want to Delete?')) {
                                                        event.preventDefault();
                                                        document.getElementById('form-delete-number{{$numberPorting->id}}').submit();
                                                        }else{
                                                        event.preventDefault();
                                                        }

                                                        "><i class="fa fa-fw fa-trash"></i></a>
                                            </div>
                                        </td>

                                        <td>{{$numberPorting->type}}</td>
                                        <td>{!! statusColor($numberPorting->status) !!}</td>
                                        <td>{{$numberPorting->date->format(config('constants.time.format'))}}</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($numberPorting->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No Number Porting for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="onsite-delivery-go-live">

                        <h3><span>Onsite Delivery/Go Live</span>
                            <a data-toggle="tooltip" data-placement="top" title="Add New"
                               class="pull-right btn btn-xs btn-default"
                               href="{{route('projects.onsite-delivery-go-live.create',$project->slug)}}">
                                <i class="fa fa-fw text-olive fa-2x fa-plus" aria-hidden="true"></i></a>
                        </h3>
                        <hr>

                        @if ($project->projectOnsiteDeliveryGoLive->isNotEmpty())

                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Location</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Comment</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($project->projectOnsiteDeliveryGoLive as $onsiteDeliveryGoLive)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <a data-toggle="tooltip" data-placement="top" title="View"
                                                   class="btn btn-xs btn-success"
                                                   href="{{url('pm/projects/'.$project->slug.'/onsite-delivery-go-live/'.$onsiteDeliveryGoLive->id)}}"><i class="fa fa-fw fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/onsite-delivery-go-live/'.$onsiteDeliveryGoLive->id.'/edit')}}"><i class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
                                                <form id="form-delete-onsite{{$onsiteDeliveryGoLive->id}}" method="post"
                                                      action="{{url('pm/projects/'.$project->slug.'/onsite-delivery-go-live/'.$onsiteDeliveryGoLive->id)}}"
                                                      style="display: none;">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}

                                                </form>

                                                <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                   class="btn btn-xs btn-danger" href="#" onclick="

                                                        if(confirm('Are you sure want to Delete?')) {
                                                        event.preventDefault();
                                                        document.getElementById('form-delete-onsite{{$onsiteDeliveryGoLive->id}}').submit();
                                                        }else{
                                                        event.preventDefault();
                                                        }

                                                        "><i class="fa fa-fw fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <td>{{$onsiteDeliveryGoLive->location}}</td>
                                        <td>{{$onsiteDeliveryGoLive->start_date->format(config('constants.time.format'))}}</td>
                                        <td>@if($onsiteDeliveryGoLive->end_date!="")
                                                {{$onsiteDeliveryGoLive->end_date->format(config('constants.time.format'))}}
                                            @endif
                                        </td>
                                        <td>{!! statusColor($onsiteDeliveryGoLive->status) !!}</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($onsiteDeliveryGoLive->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No Onsite Delivery/Go Live for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="notes">
                        <h3><span>Notes</span>

                        </h3>
                        <hr>

                        <form class= role="form" method="post"
                              action="{{route('projects.note.store',$project->slug)}}">
                            {{csrf_field()}}

                             <div class="form-group">
                                   <div class="col-sm-8">

                                        <textarea class="form-control notes" placeholder="Note" name="note" cols="30" rows="10">@if($project->projectNote !=null ){{$project->projectNote->note}}@endif</textarea>

                                    </div>
                                </div>
                            <div class="clearfix"></div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                        </form>



                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="attachments">

                        <h3><span>Attachments</span>
                            <a data-toggle="tooltip" data-placement="top" title="Add New"
                               class="pull-right btn btn-xs btn-default"
                               href="{{route('projects.attachment.create',$project->slug)}}">
                                <i class="fa fa-fw text-olive fa-2x fa-plus" aria-hidden="true"></i></a>
                        </h3>
                        <hr>

                        @if ($project->projectAttachment->isNotEmpty())

                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Title</th>
                                    <th>Created Date</th>
                                    <th>Download</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($project->projectAttachment as $attachment)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                               <form id="form-delete-attachment{{$attachment->id}}" method="post"
                                                      action="{{url('pm/projects/'.$project->slug.'/attachment/'.$attachment->id)}}"
                                                      style="display: none;">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}

                                                </form>

                                                <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                   class="btn btn-xs btn-danger" href="#" onclick="

                                                        if(confirm('Are you sure want to Delete?')) {
                                                        event.preventDefault();
                                                        document.getElementById('form-delete-attachment{{$attachment->id}}').submit();
                                                        }else{
                                                        event.preventDefault();
                                                        }

                                                        "><i class="fa fa-fw fa-trash"></i></a>
                                            </div>
                                        </td>
                                        <td>{{$attachment->title}}</td>
                                        <td>{{$attachment->created_at->format(config('constants.time.format'))}}</td>
                                        <td><i class="fa fa-paperclip"></i> <a href="{{url('pm/projects/'.$project->slug.'/attachment/'.$attachment->id)}}">{{$attachment->attachment_url}}</a></td>


                                    </tr>

                                @endforeach
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No Attachments for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif
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