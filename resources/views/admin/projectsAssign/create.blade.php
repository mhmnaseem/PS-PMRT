@extends('admin.layout.master')

@section ('header')

    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

@endsection


@section ('main-content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Projects

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Project</a></li>
                <li class="active">Create</li>
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
                            <h3 class="box-title">Create Project</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" role="form" method="post"
                              action="{{route('admin-project-assign.store')}}">
                            {{csrf_field()}}
                            <div class="box-body">

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-4 control-label">Title</label>

                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control" name="title"
                                               value="{{ old('title') }}" required autofocus>

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Description</label>

                                    <div class="col-md-6">

                                        <textarea id="editor1" rows="4" cols="50" name="description" class="form-control"
                                                  required>{{ old('description')}}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                {{--<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">--}}
                                    {{--<label for="password" class="col-md-4 control-label">Status</label>--}}

                                    {{--<div class="col-md-6">--}}

                                        {{--<select id="status" class="form-control" name="status"--}}
                                                {{--required>--}}
                                            {{--<option value="Assigned">Assigned</option>--}}
                                            {{--<option value="Inprogress">Inprogress</option>--}}
                                            {{--<option value="Complete">Complete</option>--}}
                                            {{--<option value="Closed">Closed</option>--}}
                                        {{--</select>--}}

                                        {{--@if ($errors->has('status'))--}}
                                            {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('status') }}</strong>--}}
                                    {{--</span>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                    <label for="start_date" class="col-md-4 control-label">Start date</label>

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


                                <div class="form-group{{ $errors->has('due_date') ? ' has-error' : '' }}">
                                    <label for="due_date" class="col-md-4 control-label">Due date</label>

                                    <div class="col-md-6">

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker1" name="due_date"  value="{{ old('due_date') }}" required autofocus>
                                        </div>
                                        <!-- /.input group -->


                                        @if ($errors->has('due_date'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('partner') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Partner</label>

                                <div class="col-md-6">

                                    <select class="form-control" name="partner" autofocus required>
                                        <option value=""></option>
                                        @foreach($partners as $partner)
                                            <option value="{{ $partner->id }}" @if(old('partner') == $partner->id) {{ 'selected' }} @endif>{{ $partner->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('partner'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('partner') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-warning" href="{{route('admin-project-assign.index')}}"> Back </a>
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