@extends('user.layout.master')

@section ('header')

    <link rel="stylesheet"
          href="{{asset('admin/dist/css/lightbox.min.css')}}">


@endsection

@section('title', $project->title)

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
                            <i class="fa fa-home text-success"></i> Overview </a>
                    </li>
                    <li><a href="#pd" data-toggle="tab">
                            <i class="fa fa-bullseye text-aqua" aria-hidden="true"></i> Planning and Design</a>
                    </li>
                    <li><a href="#network-assessment" data-toggle="tab">
                            <i class="fa fa-file-text text-maroon " aria-hidden="true"></i> Network Assessment</a>
                    </li>
                    <li><a href="#back-end-build-out" data-toggle="tab">
                            <i class="fa fa-shield text-fuchsia" aria-hidden="true"></i> Backend Build </a>
                    </li>
                    <li><a href="#number-porting" data-toggle="tab">
                            <i class="fa fa-server text-orange" aria-hidden="true"></i> Number Porting </a>
                    </li>
                    <li><a href="#admin-training" data-toggle="tab">
                            <i class="fa fa-book text-olive" aria-hidden="true"></i> Training </a>
                    </li>
                    <li><a href="#onsite-delivery-go-live" data-toggle="tab">
                            <i class="fa fa-shopping-cart text-light-blue" aria-hidden="true"></i> Go Live</a>
                    </li>
                    <li><a href="#notes" data-toggle="tab">
                            <i class="fa fa-pencil text-yellow" aria-hidden="true"></i> Notes</a>
                    </li>
                    <li><a href="#attachments" data-toggle="tab">
                            <i class="fa fa-paperclip text-red" aria-hidden="true"></i> Attachments</a>
                    </li>
                    <li><a href="#expenses" data-toggle="tab">
                            <i class="fa fa-credit-card text-yellow" aria-hidden="true"></i> Expenses</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="home">

                        <div class="row">

                            <div class="col-sm-12">
                                <h5><strong>Project Snap Shot</strong></h5>
                                @if ($project->ProjectPd->isNotEmpty() || $project->projectNetworkAssessment->isNotEmpty() || $project->projectAdminTraining->isNotEmpty() || $project->projectBackEndBuildOut->isNotEmpty() || $project->projectBackEndBuildOut->isNotEmpty() || $project->projectNumberPorting->isNotEmpty() || $project->projectOnsiteDeliveryGoLive->isNotEmpty())

                                    <table id="snapshot" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th class="no-sort">Project Phase</th>
                                            <th class="no-sort">Task Name</th>
                                            <th class="no-sort">Task Status</th>
                                            <th class="no-sort">Task Progress</th>
                                            <th class="no-sort">Task Time Spent</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if ($project->ProjectPd->isNotEmpty())
                                            @foreach($project->projectPd as $pd)
                                                <tr>
                                                    <td>Planning and Design</td>
                                                    <td>{{$pd->title}}</td>
                                                    <td>{!! statusColor($pd->status) !!} </td>
                                                    <td>{!! calculateSubTaskProgress($project->projectPd,$pd->id) !!}</td>
                                                    <td>{!! timeSpent($pd->start_date,$pd->end_date) !!}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        @if ($project->projectNetworkAssessment->isNotEmpty())
                                            @foreach($project->projectNetworkAssessment as $network)
                                                <tr>
                                                    <td>Network Assessment</td>
                                                    <td>{{$network->title}}</td>
                                                    <td>{!! statusColor($network->status) !!} </td>
                                                    <td>{!! calculateSubTaskProgress($project->projectNetworkAssessment,$network->id) !!}</td>
                                                    <td>{!! timeSpent($network->start_date,$network->end_date) !!}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        @if ($project->projectBackEndBuildOut->isNotEmpty())
                                            @foreach($project->projectBackEndBuildOut as $backend)
                                                <tr>
                                                    <td>Back End Build Out</td>
                                                    <td>{{$backend->title}}</td>
                                                    <td>{!! statusColor($backend->status) !!}</td>
                                                    <td>{!! calculateSubTaskProgress($project->projectBackEndBuildOut,$backend->id) !!}</td>
                                                    <td>{!! timeSpent($backend->start_date,$backend->end_date) !!}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        @if ($project->projectNumberPorting->isNotEmpty())
                                            @foreach($project->projectNumberPorting as $numberPort)
                                                <tr>
                                                    <td>Number Porting</td>
                                                    <td>{{$numberPort->title}}</td>
                                                    <td>{!! statusColor($numberPort->status) !!}</td>
                                                    <td>{!! calculateSubTaskProgress($project->projectNumberPorting,$numberPort->id) !!}</td>
                                                    <td>{!! timeSpent($numberPort->start_date,$numberPort->end_date) !!}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        @if ($project->projectAdminTraining->isNotEmpty())
                                            @foreach($project->projectAdminTraining as $admin)
                                                <tr>
                                                    <td>Training</td>
                                                    <td>{{$admin->title}}</td>
                                                    <td>{!! statusColor($admin->status) !!}</td>
                                                    <td>{!! calculateSubTaskProgress($project->projectAdminTraining,$admin->id) !!}</td>
                                                    <td>{!! timeSpent($admin->start_date,$admin->end_date) !!}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        @if ($project->projectOnsiteDeliveryGoLive->isNotEmpty())
                                            @foreach($project->projectOnsiteDeliveryGoLive as $onSiteDelivery)
                                                <tr>
                                                    <td>Go Live</td>
                                                    <td>{{$onSiteDelivery->title}}</td>
                                                    <td>{!! statusColor($onSiteDelivery->status) !!}</td>
                                                    <td>{!! calculateSubTaskProgress($project->projectOnsiteDeliveryGoLive,$onSiteDelivery->id) !!}</td>
                                                    <td>{!! timeSpent($onSiteDelivery->start_date,$onSiteDelivery->end_date) !!}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>

                                    </table>

                                    <h5><strong>Export Snap Shot</strong></h5>
                                    <div id="buttons"> <a class="btn btn-default" href="{{route('overview.export',$project->slug)}}">PDF</a></div>



                                @else

                                    <div class="callout callout-info">
                                        <h4> No Task SnapShot For this Project !</h4>

                                        <p>Please Create a Task..!</p>
                                    </div>

                                @endif
                            </div>
                        </div>

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
                                            {{--@if($project->star==0)--}}
                                            {{--<a href="#" data-toggle="tooltip" data-placement="top"--}}
                                            {{--title="Add to Star" data-slug="{{$project->slug}}" data-value="1"--}}
                                            {{--data-source="{{route('star')}}" class="ajax btn btn-default btn-xs">--}}
                                            {{--<i--}}
                                            {{--class="fa fa-fw fa-2x fa-star-o"></i></a>--}}
                                            {{--@else--}}
                                            {{--<a href="#" data-toggle="tooltip" data-placement="top"--}}
                                            {{--title="Remove from Star" data-slug="{{$project->slug}}"--}}
                                            {{--data-value="0" data-source="{{route('star')}}"--}}
                                            {{--class="ajax btn btn-default btn-xs"> <i--}}
                                            {{--class="fa fa-fw fa-2x fa-star"></i></a>--}}
                                            {{--@endif--}}
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
                                            Project Progress</strong>

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


                                        <textarea disabled
                                                  class="notes">@if($project->projectNote !=null ){{$project->projectNote->note}}@endif</textarea>

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


                        <h3><span>Planning and Design</span>
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
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time Spent</th>
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
                                                   href="{{url('pm/projects/'.$project->slug.'/pd/'.$pd->id)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/pd/'.$pd->id.'/edit')}}"><i
                                                            class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
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
                                        <td>{{$pd->title}}</td>
                                        <td>{!! statusColor($pd->status) !!}</td>
                                        <td>{{$pd->start_date->format(config('constants.time.format'))}}</td>
                                        <td>@if($pd->end_date!="")
                                                {{$pd->end_date->format(config('constants.time.format'))}}
                                            @endif
                                        </td>
                                        <td>{!! timeSpent($pd->start_date,$pd->end_date) !!}</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($pd->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                                </tbody>
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

                        <h3><span>Network Assessment</span>
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
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time Spent</th>
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
                                                   href="{{url('pm/projects/'.$project->slug.'/network-assessment/'.$networkAssessment->id)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/network-assessment/'.$networkAssessment->id.'/edit')}}"><i
                                                            class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
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
                                        <td>{{$networkAssessment->title}}</td>
                                        <td>{!! statusColor($networkAssessment->status) !!}</td>
                                        <td>{{$networkAssessment->start_date->format(config('constants.time.format'))}}</td>
                                        <td>@if($networkAssessment->end_date!="")
                                                {{$networkAssessment->end_date->format(config('constants.time.format'))}}
                                            @endif
                                        </td>
                                        <td>{!! timeSpent($networkAssessment->start_date,$networkAssessment->end_date) !!}</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($networkAssessment->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> Network Assessment for this Project !</h4>

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
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time Spent</th>
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
                                                   href="{{url('pm/projects/'.$project->slug.'/back-end-build-out/'.$backEndBuildOut->id)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/back-end-build-out/'.$backEndBuildOut->id.'/edit')}}"><i
                                                            class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
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
                                        <td>{{$backEndBuildOut->title}} </td>
                                        <td>{!! statusColor($backEndBuildOut->status) !!}</td>
                                        <td>{{$backEndBuildOut->start_date->format(config('constants.time.format'))}}</td>
                                        <td>@if($backEndBuildOut->end_date!="")
                                                {{$backEndBuildOut->end_date->format(config('constants.time.format'))}}
                                            @endif
                                        </td>
                                        <td>{!! timeSpent($backEndBuildOut->start_date,$backEndBuildOut->end_date) !!}</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($backEndBuildOut->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                                </tbody>
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
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time Spent</th>
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
                                                   href="{{url('pm/projects/'.$project->slug.'/number-porting/'.$numberPorting->id)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/number-porting/'.$numberPorting->id.'/edit')}}"><i
                                                            class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
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
                                        <td>{{$numberPorting->title}}</td>
                                        <td>{!! statusColor($numberPorting->status) !!}</td>
                                        <td>{{$numberPorting->start_date->format(config('constants.time.format'))}}</td>
                                        <td>@if($numberPorting->end_date!="")
                                                {{$numberPorting->end_date->format(config('constants.time.format'))}}
                                            @endif
                                        </td>
                                        <td>{!! timeSpent($numberPorting->start_date,$numberPorting->end_date) !!}</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($numberPorting->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No Number Porting for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="admin-training">

                        <h3><span>Training</span>
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
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time Spent</th>
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
                                                   href="{{url('pm/projects/'.$project->slug.'/admin-training/'.$adminTraining->id)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/admin-training/'.$adminTraining->id.'/edit')}}"><i
                                                            class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
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
                                        <td>{{$adminTraining->start_date->format(config('constants.time.format'))}}</td>
                                        <td>@if($adminTraining->end_date!="")
                                                {{$adminTraining->end_date->format(config('constants.time.format'))}}
                                            @endif
                                        </td>
                                        <td>{!! timeSpent($adminTraining->start_date,$adminTraining->end_date) !!}</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($adminTraining->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No Training for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="onsite-delivery-go-live">

                        <h3><span>Go Live</span>
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
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Time Spent</th>
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
                                                   href="{{url('pm/projects/'.$project->slug.'/onsite-delivery-go-live/'.$onsiteDeliveryGoLive->id)}}"><i
                                                            class="fa fa-fw fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                   class="btn btn-xs btn-warning"
                                                   href="{{url('pm/projects/'.$project->slug.'/onsite-delivery-go-live/'.$onsiteDeliveryGoLive->id.'/edit')}}"><i
                                                            class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
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
                                        <td>{{$onsiteDeliveryGoLive->title}}</td>
                                        <td>{{$onsiteDeliveryGoLive->location}}</td>
                                        <td>{{$onsiteDeliveryGoLive->start_date->format(config('constants.time.format'))}}</td>
                                        <td>@if($onsiteDeliveryGoLive->end_date!="")
                                                {{$onsiteDeliveryGoLive->end_date->format(config('constants.time.format'))}}
                                            @endif
                                        </td>
                                        <td>{!! timeSpent($onsiteDeliveryGoLive->start_date,$onsiteDeliveryGoLive->end_date) !!}</td>
                                        <td>{!! statusColor($onsiteDeliveryGoLive->status) !!}</td>
                                        <td>
                                            {!! htmlspecialchars_decode(str_limit($onsiteDeliveryGoLive->comment,350)) !!}
                                        </td>


                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4> No Go Live for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="notes">
                        <h3><span>Notes</span>

                        </h3>
                        <hr>

                        <form class=role="form" method="post"
                              action="{{route('projects.note.store',$project->slug)}}">
                            {{csrf_field()}}

                            <div class="form-group">
                                <div class="col-sm-8">

<textarea class="form-control notes" placeholder="Note" name="note" cols="30"
          rows="10">@if($project->projectNote !=null ){{$project->projectNote->note}}@endif</textarea>

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
                                        <td><i class="fa fa-paperclip"></i> <a
                                                    href="{{url('pm/projects/'.$project->slug.'/attachment/'.$attachment->id)}}">{{$attachment->attachment_url}}</a>
                                        </td>


                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        @else

                            <div class="callout callout-info">
                                <h4>No Attachments for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="expenses">

                        <h3><span>Expenses</span>
                            <a data-toggle="tooltip" data-placement="top" title="Add New"
                               class="pull-right btn btn-xs btn-default"
                               href="{{route('projects.expense.create',$project->slug)}}">
                                <i class="fa fa-fw text-olive fa-2x fa-plus" aria-hidden="true"></i></a>
                        </h3>
                        <hr>

                        @if ($project->projectExpenses->isNotEmpty())

                            @php
                                $grouped = $project->projectExpenses->groupBy('expense_type');

                            @endphp

                            <table id="expense" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Total</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($grouped as $title => $expenses)
                                    <tr>
                                        <td>{{$title}} - ${{number_format($expenses->sum('amount'),2)}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach($expenses as $expense)
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <a data-toggle="tooltip" data-placement="top" title="View"
                                                       class="btn btn-xs btn-success"
                                                       href="{{url('pm/projects/'.$project->slug.'/expense/'.$expense->id)}}"><i
                                                                class="fa fa-fw fa-arrow-circle-o-right"
                                                                aria-hidden="true"></i></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Edit"
                                                       class="btn btn-xs btn-warning"
                                                       href="{{url('pm/projects/'.$project->slug.'/expense/'.$expense->id.'/edit')}}"><i
                                                                class="fa fa-fw fa-edit" aria-hidden="true"></i></a>
                                                    <form id="form-delete-expense{{$expense->id}}" method="post"
                                                          action="{{url('pm/projects/'.$project->slug.'/expense/'.$expense->id)}}"
                                                          style="display: none;">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}

                                                    </form>

                                                    <a data-toggle="tooltip" data-placement="top" title="Delete"
                                                       class="btn btn-xs btn-danger" href="#" onclick="

                                                            if(confirm('Are you sure want to Delete?')) {
                                                            event.preventDefault();
                                                            document.getElementById('form-delete-expense{{$expense->id}}').submit();
                                                            }else{
                                                            event.preventDefault();
                                                            }

                                                            "><i class="fa fa-fw fa-trash"></i></a>
                                                </div>
                                            </td>
                                            <td>
                                                {!! htmlspecialchars_decode(str_limit($expense->description,350)) !!}
                                            </td>
                                            <td>{{$expense->date->format(config('constants.time.format'))}}</td>
                                            <td>${{number_format($expense->amount,"2")}}</td>


                                        </tr>


                                    @endforeach
                                @endforeach
                                <tr class="group">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total -
                                            ${{number_format($project->projectExpenses->sum('amount'),2)}}</strong></td>
                                </tr>
                                </tbody>
                            </table>



                            <h5><strong>Export Expenses</strong></h5>
                            <div id="expense_export">
                                <a class="btn btn-default" href="{{route('expense.export',$project->slug)}}">PDF</a>
                            </div>
                        @else

                            <div class="callout callout-info">
                                <h4>No Expenses for this Project !</h4>

                                <p>Please Create One..!</p>
                            </div>

                        @endif


                        @if ($project->projectExpenses->isNotEmpty())

                            <br>
                            <h4>Expenses Attachments</h4>
                            <br>
                            <div class="row">

                                @foreach($project->projectExpenses as $expenseAttachment)

                                    <div class="col-sm-3">



                                            <div class="img-box">
                                                <a href="{{asset(config('constants.upload_path.attachments').$expenseAttachment->attachment_url)}}"
                                                   data-lightbox="{{$expenseAttachment->id}}"
                                                   data-title="{{$expenseAttachment->expense_type}}"><img
                                                            class="img-responsive"
                                                            src="{{asset(config('constants.upload_path.attachments').$expenseAttachment->attachment_url)}}"></a>

                                            </div>
                                        <div class="attachment_text">
                                            <p class="attachment-title">Type: {{$expenseAttachment->expense_type}}</p>
                                            <p class="attachment-title">Date: {{$expenseAttachment->date->format(config('constants.time.format'))}}</p>
                                            <p class="attachment-title">Amount: ${{number_format($expenseAttachment->amount,"2")}}</p>
                                        </div>
                                    </div>


                                @endforeach


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

    <script src="{{asset('admin/dist/js/lightbox.min.js')}}"></script>

    <script>
        // snap shot data table

        $(function () {
            var table = $('#snapshot,#expense').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'info': true,
                'autoWidth': false,

                "order": [],
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false
                }]

            });

        });



    </script>


@endsection