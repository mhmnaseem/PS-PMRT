@extends('pdf.layout.template')

@section ('main-content')

<h3> {{$reportTitle}} Expenses </h3>
<p>Project Manager: {{$name}} <br>
<p>Report Created Date: {{$date}} </p>


@if ($project->projectExpenses->isNotEmpty())

    @php
        $grouped = $project->projectExpenses->groupBy('expense_type');

    @endphp

    <table class="table table-bordered table-striped">
        <thead>
        <tr>

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

            </tr>
            @foreach($expenses as $expense)
                <tr>

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
            <td><strong>Total -
                    ${{number_format($project->projectExpenses->sum('amount'),2)}}</strong></td>
        </tr>
        </tbody>
    </table>
@endif


@if ($project->projectExpenses->isNotEmpty())

    <br>
    <h4>Expenses Attachments</h4>
    <br>
    <table cellspacing="4" cellpadding="4" width = "100%" border="0">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @php

            $i=0;
            $n=3;

        @endphp

        @foreach($project->projectExpenses as $expenseAttachment)


            @if ($i++ % $n == 0)

                <tr>
                    @endif


                    <td><img width="200" height="250"
                             src="{{asset(config('constants.upload_path.attachments').$expenseAttachment->attachment_url)}}">

                        <br>
                        Type: {{$expenseAttachment->expense_type}}<br>
                        Date: {{$expenseAttachment->date->format(config('constants.time.format'))}}<br>
                        Amount: ${{number_format($expenseAttachment->amount,"2")}}<br>
                    </td>


                    @if ($i % $n == 0)
                </tr>
                @endif


                @endforeach

                @if ($i % $n != 0)
                </tr>
            @endif

        </tbody>
    </table>


@endif



@endsection



