@extends('backend.layout.master')

@section('title', $title)
@section('page_name', $page_name)
@section('page_title', $page_title)

@section('content')

    <div class="card card-default card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Update Profile Information</h3>

            <div class="card-tools">
                <a href="{{ route('admin.profile') }}" class="btn btn-sm btn-success">View Profile</a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                {{--                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.profile.update',Auth::user()->id) }}" role="form" enctype="multipart/form-data">
                @csrf

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Name:</label>
                                <input type="text" name ="name" class="form-control" value="{{ $user->name }}" placeholder="Enter Your First Name">
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email </label>
                                <input type="text" name ="email" class="form-control" value="{{ $user->email }}" placeholder="Enter your email">
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            </div>



                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="col-md-12">

                        <!-- /.card-body -->

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </div>
                    <!-- /.col -->

                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>

@endsection
