@extends('backend.layout.master')

@section('title', $title)
@section('page_name', $page_name)
@section('page_title', $page_title)

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-default card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">User List</h3>
                            <div class="card-tools">
                                @if(auth()->user()->can('user-create'))
                                <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-success">Create</a>
                                @endif
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                                {{--                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            @if ($message = Session::get('failed'))
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $datas as $key => $data)
                                    <tr>
                                        <td width="1%">{{ ++$key }}</td>
                                        <td>
                                            {{ $data->name }}
                                        </td>
                                        <td>{{ $data->email }}</td>
                                        <td width="3%">
                                            <div class="btn-group">
                                                @if(auth()->user()->can('user-edit'))
                                                <a href="{{ route('admin.user.edit',$data->id) }}" class="btn btn-success btn-sm">Edit</a>
                                                @endif
                                                @if($data->id != Auth::user()->id)
                                                @if(auth()->user()->can('user-delete'))
                                                <form method="post" action="{{ route('admin.user.destroy',$data->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure Wants to be Delete?')">Delete</button>
                                                </form>
                                                @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

@endsection

@push('header_style')

    <link rel="stylesheet" href="{{asset('backend/assets')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

@endpush

@push('footer_script')

    <script src="{{asset('backend/assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/jszip/jszip.min.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('backend/assets')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

@endpush

