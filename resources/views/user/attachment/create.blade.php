@extends('user.layout.master')

@section ('header')

@endsection


@section ('main-content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Attachment

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Attachment</a></li>
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
                            <h3 class="box-title">Create Attachment</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" role="form" method="post"
                              action="{{route('projects.attachment.store',$slug)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="box-body">


                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-4 control-label">Title</label>

                                    <div class="col-md-6">


                                            <input type="text" id="title" class="form-control" name="title"  value="{{ old('title') }}" required autofocus>

                                      @if ($errors->has('title'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                                    <label for="attachment" class="col-md-4 control-label">Attachment</label>

                                    <div class="col-md-6">

                                       <input type="file" name="attachment" id="attachment" required>

                                        @if ($errors->has('attachment'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-warning" href="{{url('pm/projects/'.$slug.'#attachments')}}"> Back </a>
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

            CKEDITOR.replace('editor1');
        });
    </script>

@endsection