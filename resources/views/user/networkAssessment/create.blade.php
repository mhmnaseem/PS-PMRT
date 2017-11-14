@extends('user.layout.master')

@section ('header')



@endsection


@section ('main-content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Network Assessment

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Network Assessment</a></li>
                <li class="active">Create</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Network Assessment</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <input type="hidden" id="ajax_url"  data-set-value="0"  value="{{ route('time.spent') }}">

                        <form class="form-horizontal" role="form" method="post"
                              action="{{route('projects.network-assessment.store',$slug)}}">
                            {{csrf_field()}}
                            <div class="box-body">

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-4 control-label">Title</label>

                                    <div class="col-md-6">


                                        <input type="text" list="title_hint" id="title" class="form-control" name="title"  value="{{ old('title') }}" required autofocus>

                                        <datalist id="title_hint">
                                            <option value="Network assessment Call">
                                            <option value="Other">
                                        </datalist>

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="status" class="col-md-4 control-label">Status</label>

                                    <div class="col-md-6">

                                        {!! selectCreate('status') !!}

                                        @if ($errors->has('status'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                    <label for="datepicker" class="col-md-4 control-label">Start Date</label>

                                    <div class="col-md-6">

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" name="start_date"  value="{{ old('start_date') }}" required autofocus>
                                        </div>
                                        <!-- /.input group -->


                                        @if ($errors->has('start_date'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                    <label for="datepicker1" class="col-md-4 control-label">End Date</label>

                                    <div class="col-md-6">

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker1" name="end_date"  value="{{ old('end_date') }}" autofocus>
                                        </div>
                                        <!-- /.input group -->


                                        @if ($errors->has('end_date'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Time Spent</label>
                                    <div class="col-md-6">
                                        <label id="time_spent" class="control-label text-orange"></label>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Comment</label>

                                    <div class="col-md-6">

                                        <textarea id="editor1" rows="4" cols="50" name="comment" class="form-control"
                                                  required>{{ old('comment')}}</textarea>
                                        @if ($errors->has('comment'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-warning" href="{{url('pm/projects/'.$slug.'#network-assessment')}}"> Back </a>
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