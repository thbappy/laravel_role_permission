@extends('backend.layout.master')

@section('title', $title)
@section('page_name', $page_name)
@section('page_title', $page_title)

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Update Role </h3>

                    <div class="card-tools">
                        <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-success">List</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                        {{--                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <form method="POST" action="{{ route('admin.role.update',$data->id) }}" role="form">
                                @csrf
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

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role Name</label>
                                            <input type="text" name ="name" class="form-control" value="{{ $data->name }}" placeholder="Enter Role Name">
                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Permission Name</label>
                                                    <label for="exampleInputEmail1"><input type="checkbox" name="select-all" id="select-all" /> Select All</label>
                                                    <div class="container row">
                                                        @foreach($permissions as $key=> $permission)
                                                            <div class="form-check col-md-3">
                                                                <input @if($data->permissions->contains($permission->id))) checked="checked" @endif name="permission[]" value="{{ $permission->id }}" class="form-check-input" type="checkbox">
                                                                <label class="form-check-label">{{ $permission->name }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <small class="text-danger">{{ $errors->first('permission') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.col -->
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@push('header_style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('backend/assets')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('backend/assets')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


    @push('footer_script')
        <!-- Select2 -->
        <script src="{{asset('backend/assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('backend/assets')}}/plugins/select2/js/select2.full.min.js"></script>
        <script>
            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
            })

            $('#select-all').click(function(event) {
                if(this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $(':checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });
        </script>
    @endpush

