@extends('partner.layout.master')

@section ('header')

    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endsection


@section ('main-content')



    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                PM's

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">PM's</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">All PM's</h3>
                    <a  class="col-md-offset-5 btn btn-success" href="{{route('pm.create')}}"> Add New </a>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>

                    </div>
                </div>
                <div class="box-body">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Created</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pms as $pm)
                                    <tr>

                                        <td>
                                            <div class="btn-group">
                                            <a data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-xs btn-warning" href ="{{route('pm.edit',$pm->slug)}}"><i class="fa fa-fw fa-edit"></i></a>
                                        <form id="form-delete-{{$pm->id}}" method="post" action="{{route('pm.destroy',$pm->slug)}}" style="display: none;">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}

                                        </form>

                                        <a data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-xs btn-danger" href="#" onclick="

                                                    if(confirm('Are you sure want to Delete?')) {
                                                    event.preventDefault();
                                                    document.getElementById('form-delete-{{$pm->id}}').submit();
                                                    }else{
                                                    event.preventDefault();
                                                    }

                                                    "><i class="fa fa-fw fa-trash"></i></a>
                                            </div>
                                        </td>

                                        <td>{{$pm->name}}</td>
                                        <td>{{$pm->email}}</td>
                                        <td>{{$pm->created_at->toDateString()}}</td>



                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

@section('footer')

    <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>

@endsection