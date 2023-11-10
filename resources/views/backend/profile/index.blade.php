@extends('backend.layout.master')

@section('title', $title)
@section('page_name', $page_name)
@section('page_title', $page_title)

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">

                            @if(Auth::user()->photo)
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{asset("")}}{{ Auth::user()->photo }}"
                                     alt="User profile picture">
                            @else
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{asset('admin/dist/img/user4-128x128.jpg')}}"
                                     alt="User profile picture">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->full_name }}</h3>

                        <p class="text-muted text-center">{{ Auth::user()->phone }}</p>
                        <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Designation</strong>

                        <p class="text-muted">
                            {{Auth::user()->designation}}
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">{{ Auth::user()->permanent_address }}</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-danger card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change Password</a></li>
                            <li class="nav-item"><a class="nav-link bg-success" href="{{ route('admin.profile.edit',Auth::user()->id) }}">Edit Profile</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
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
                                <form action="{{ route('admin.profile.changepassword',Auth::user()->id) }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="current-password" class="form-control" id="oldpass" placeholder="Old Password">
                                            <small class="text-danger">{{ $errors->first('current-password') }}</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="new-password" class="form-control" id="inputEmail" placeholder="New Password">
                                            <small class="text-danger">{{ $errors->first('new-password') }}</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="new-password_confirmation" class="form-control" id="inputName2" placeholder="Confirm Password">
                                            <small class="text-danger">{{ $errors->first('new-password_confirmation') }}</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

@endsection
