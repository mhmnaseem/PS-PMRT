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
                Back End Build Out

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Project</a></li>
                <li class="active"> Back End Build Out Update</li>
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
                        <form class="form-horizontal" role="form" method="post" action="{{url('pm/projects/'.$slug.'/back-end-build-out/'.$backEndBuildOut->id)}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="box-body">



                                <div class="form-group{{ $errors->has('user_upload') ? ' has-error' : '' }}">
                                    <label for="status" class="col-md-4 control-label">User Upload</label>

                                    <div class="col-md-6">

                                        {!! selectUpdate('user_upload',$backEndBuildOut->user_upload) !!}

                                        @if ($errors->has('user_upload'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('user_upload') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('call_flows') ? ' has-error' : '' }}">
                                    <label for="status" class="col-md-4 control-label">Call Flows</label>

                                    <div class="col-md-6">

                                        {!! selectUpdate('call_flows',$backEndBuildOut->call_flows) !!}

                                        @if ($errors->has('call_flows'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('call_flows') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Comment</label>

                                    <div class="col-md-6">

                                        <textarea id="editor1" rows="4" cols="50" name="comment" class="form-control"
                                                  required>{{ old('comment',$backEndBuildOut->comment)}}</textarea>
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
                                <a class="btn btn-warning" href="{{url('pm/projects/'.$slug.'#back-end-build-out')}}"> Back </a>
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