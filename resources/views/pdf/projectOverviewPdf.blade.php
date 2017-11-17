@extends('pdf.layout.template')

@section ('main-content')

    <h3> {{$reportTitle}}</h3>
    <p>Project Manager: {{$name}} <br>
    <p>Report Created Date: {{$date}} </p>

    @if ($project->ProjectPd->isNotEmpty() || $project->projectNetworkAssessment->isNotEmpty() || $project->projectAdminTraining->isNotEmpty() || $project->projectBackEndBuildOut->isNotEmpty() || $project->projectBackEndBuildOut->isNotEmpty() || $project->projectNumberPorting->isNotEmpty() || $project->projectOnsiteDeliveryGoLive->isNotEmpty())

        <table class="table table-bordered table-striped table-condensed">
            <thead>
            <tr>
                <th>Project Phase</th>
                <th>Task Name</th>
                <th>Task Status</th>
                <th>Task Progress</th>
                <th>Task Time Spent</th>
            </tr>
            </thead>
            <tbody>
            @if ($project->ProjectPd->isNotEmpty())
                @foreach($project->projectPd as $pd)
                    <tr>
                        <td>Planning and Design</td>
                        <td>{{$pd->title}}</td>
                        <td>{{$pd->status}} </td>
                        <td>{!! calculateSubTaskProgressValue($project->projectPd,$pd->id) !!}</td>
                        <td>{!! timeSpent($pd->start_date,$pd->end_date) !!}</td>
                    </tr>
                @endforeach
            @endif

            @if ($project->projectNetworkAssessment->isNotEmpty())
                @foreach($project->projectNetworkAssessment as $network)
                    <tr>
                        <td>Network Assessment</td>
                        <td>{{$network->title}}</td>
                        <td>{{$network->status}} </td>
                        <td>{!! calculateSubTaskProgressValue($project->projectNetworkAssessment,$network->id) !!}</td>
                        <td>{!! timeSpent($network->start_date,$network->end_date) !!}</td>
                    </tr>
                @endforeach
            @endif

            @if ($project->projectBackEndBuildOut->isNotEmpty())
                @foreach($project->projectBackEndBuildOut as $backend)
                    <tr>
                        <td>Back End Build Out</td>
                        <td>{{$backend->title}}</td>
                        <td>{{$backend->status}}</td>
                        <td>{!! calculateSubTaskProgressValue($project->projectBackEndBuildOut,$backend->id) !!}</td>
                        <td>{!! timeSpent($backend->start_date,$backend->end_date) !!}</td>
                    </tr>
                @endforeach
            @endif

            @if ($project->projectNumberPorting->isNotEmpty())
                @foreach($project->projectNumberPorting as $numberPort)
                    <tr>
                        <td>Number Porting</td>
                        <td>{{$numberPort->title}}</td>
                        <td>{{$numberPort->status}}</td>
                        <td>{!! calculateSubTaskProgressValue($project->projectNumberPorting,$numberPort->id) !!}</td>
                        <td>{!! timeSpent($numberPort->start_date,$numberPort->end_date) !!}</td>
                    </tr>
                @endforeach
            @endif

            @if ($project->projectAdminTraining->isNotEmpty())
                @foreach($project->projectAdminTraining as $admin)
                    <tr>
                        <td>Training</td>
                        <td>{{$admin->title}}</td>
                        <td>{{$admin->status}}</td>
                        <td>{!! calculateSubTaskProgressValue($project->projectAdminTraining,$admin->id) !!}</td>
                        <td>{!! timeSpent($admin->start_date,$admin->end_date) !!}</td>
                    </tr>
                @endforeach
            @endif

            @if ($project->projectOnsiteDeliveryGoLive->isNotEmpty())
                @foreach($project->projectOnsiteDeliveryGoLive as $onSiteDelivery)
                    <tr>
                        <td>Go Live</td>
                        <td>{{$onSiteDelivery->title}}</td>
                        <td>{{$onSiteDelivery->status}}</td>
                        <td>{!! calculateSubTaskProgressValue($project->projectOnsiteDeliveryGoLive,$onSiteDelivery->id) !!}</td>
                        <td>{!! timeSpent($onSiteDelivery->start_date,$onSiteDelivery->end_date) !!}</td>
                    </tr>
                @endforeach
            @endif

            </tbody>

        </table>

    @endif

@endsection



