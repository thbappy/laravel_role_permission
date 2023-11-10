<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{asset('backend/assets')}}/dist/img/AdminLTELogo.png" alt="Admin Template" class="brand-image">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Auth::user()->photo)
                    <img src="{{asset(Auth::user()->photo)}}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{asset('backend/assets')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('admin.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link">
                        <i style="color:red" class="nav-icon fas fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>


{{--                <li class="nav-header">RECORD DOPTOR</li>--}}
                @if(auth()->user()->can('role-list') || auth()->user()->can('role-create'))
                <li class="nav-item nav-item {{ Route::currentRouteNamed( 'admin.role.*' ) ?  'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::currentRouteNamed( 'admin.role.*' ) ?  'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Role
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->can('role-list'))
                        <li class="nav-item">
                            <a href="{{ route('admin.role.index') }}" class="nav-link {{ Route::currentRouteNamed( 'admin.role.index' ) ?  'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->can('role-create'))
                        <li class="nav-item">
                            <a href="{{ route('admin.role.create') }}" class="nav-link {{ Route::currentRouteNamed( 'admin.role.create' ) ?  'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if(auth()->user()->can('permission-list') || auth()->user()->can('permission-create'))
                <li class="nav-item nav-item {{ Route::currentRouteNamed( 'admin.permission.*' ) ?  'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::currentRouteNamed( 'admin.permission.*' ) ?  'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Permission
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->can('permission-list'))
                        <li class="nav-item">
                            <a href="{{ route('admin.permission.index') }}" class="nav-link {{ Route::currentRouteNamed( 'admin.permission.index' ) ?  'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->can('permission-create'))
                        <li class="nav-item">
                            <a href="{{ route('admin.permission.create') }}" class="nav-link {{ Route::currentRouteNamed( 'admin.permission.create' ) ?  'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if(auth()->user()->can('user-list') || auth()->user()->can('user-create'))
{{--                <li class="nav-header">RECORD DOPTOR</li>--}}
                <li class="nav-item nav-item {{ Route::currentRouteNamed( 'admin.user.*' ) ?  'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::currentRouteNamed( 'admin.user.*' ) ?  'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->can('user-list'))
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link {{ Route::currentRouteNamed( 'admin.user.index' ) ?  'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->can('user-create'))
                        <li class="nav-item">
                            <a href="{{ route('admin.user.create') }}" class="nav-link {{ Route::currentRouteNamed( 'admin.user.create' ) ?  'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
