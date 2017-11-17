@extends('user.layout.master')

@section ('header')



@endsection


@section ('main-content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Expenses

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Project</a></li>
                <li class="active">Expenses Update</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                {{--@include('inc.messages')--}}

                <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">

                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <input type="hidden" id="expense"  data-set-value="1" >
                        <form class="form-horizontal" role="form" method="post" action="{{url('pm/projects/'.$slug.'/expense/'.$expense->id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="box-body">

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-4 control-label">Expense Type</label>

                                    <div class="col-md-6">


                                        <input type="text" list="expense_hint" id="title" class="form-control" name="expense_type"  value="{{ old('expense_type',$expense->expense_type) }}" required autofocus>

                                        <datalist id="expense_hint">
                                            <option value="None">
                                            <option value="Entertainment">
                                            <option value="Fuel/mileage">
                                            <option value="Lodging">
                                            <option value="Meals">
                                            <option value="Other">
                                            <option value="Phone">
                                            <option value="Transportation">
                                        </datalist>

                                        @if ($errors->has('expense_type'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('expense_type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Description</label>

                                    <div class="col-md-6">

                                        <textarea id="editor1" rows="4" cols="50" name="description"
                                                  class="form-control"
                                                  required>{{ old('description',$expense->description)}}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                    <label for="status" class="col-md-4 control-label">Amount $</label>

                                    <div class="col-md-6">

                                        <input type="number" step="0.01" id="amount" class="form-control" name="amount"
                                               value="{{ old('amount',$expense->amount) }}" required autofocus>

                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                    <label for="datepicker" class="col-md-4 control-label">Date</label>

                                    <div class="col-md-6">

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="expensePicker"
                                                   name="date" data-start-date="{{$expense->date}}"  value="{{ old('date',$expense->date) }}" required autofocus>
                                        </div>
                                        <!-- /.input group -->


                                        @if ($errors->has('date'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                    <label for="status" class="col-md-4 control-label">Attachments</label>

                                    <div class="col-md-6">

                                        <input type="file" class="form-control" name="image"/>

                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>




                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-warning" href="{{url('pm/projects/'.$slug.'#expenses')}}"> Back </a>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->




@endsection

@section('footer')




@endsection