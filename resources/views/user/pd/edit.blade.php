@extends('user.layout.master')

@section ('header')

    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

@endsection


@section ('main-content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Planning and Design Update

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Project</a></li>
                <li class="active">Planning and Design Update</li>
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
                        <form class="form-horizontal" role="form" method="post" action="{{url('pm/projects/'.$slug.'/pd/'.$pd->id)}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="box-body">

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-4 control-label">Title</label>

                                    <div class="col-md-6">


                                        <input type="text" list="title_hint" id="title" class="form-control" name="title"  value="{{ old('title',$pd->title) }}" required autofocus>

                                        <datalist id="title_hint">
                                            <option value="On site visit">
                                            <option value="Remote session">
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
                                    <label for="title" class="col-md-4 control-label">Status</label>

                                    <div class="col-md-6">

                                        {!! selectUpdate('status',$pd->status) !!}

                                        @if ($errors->has('status'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
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
                                            <input type="text" class="form-control pull-right" id="datepicker" name="date"  value="{{ old('date',$pd->date->format(config('constants.time.format'))) }}" autofocus>
                                        </div>
                                        <!-- /.input group -->


                                        @if ($errors->has('date'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('time_spent') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Time Spent</label>

                                    <div class="col-md-3">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <label for="name" class="col-md-4 control-label">Day/s</label>
                                            </div>

                                            <div class="col-md-8">
                                                <select class="form-control" name="day" autofocus>

                                                    @for ($i = 0; $i <= 100; $i++)
                                                        <option value="{{$i}}" @if(old('day',$pd->day) == $i) {{ 'selected' }} @endif>{{ $i }}</option>
                                                    @endfor

                                                </select>
                                            </div>

                                            @if ($errors->has('day'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('day') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="name" class="col-md-4 control-label">Hour/s</label>
                                            </div>

                                            <div class="col-md-8">
                                                <select class="form-control" name="hour" autofocus>


                                                    @for ($i = 0; $i <= 23; $i++)
                                                        <option value="{{$i}}" @if(old('hour',$pd->hour) == $i) {{ 'selected' }} @endif>{{ $i }}</option>
                                                    @endfor


                                                </select>
                                            </div>
                                            @if ($errors->has('hour'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('hour') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Comment</label>

                                    <div class="col-md-6">

                                        <textarea id="editor1" rows="4" cols="50" name="comment" class="form-control"
                                                  required>{{ old('comment',$pd->comment)}}</textarea>
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
                                <a class="btn btn-warning" href="{{url('pm/projects/'.$slug.'#pd')}}"> Back </a>
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


    <script src="{{asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/ckeditor/ckeditor.js')}}"></script>

    <script>
        $(function () {
            //Date picker
            $('#datepicker').datepicker({
                format: '{{config('constants.time.date_picker')}}',
                autoclose: true,
                todayHighlight: true
            });
            $('#datepicker1').datepicker({
                format: '{{config('constants.time.date_picker')}}',
                autoclose: true,
                todayHighlight: true
            });

            CKEDITOR.replace('editor1');
        });
    </script>

@endsection