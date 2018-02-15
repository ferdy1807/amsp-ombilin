<header class="main-header">
    <!-- Logo -->
    <a class="logo" href="{{url('/')}}">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <b>
                P
            </b>
            LN
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <b>
                PLN
            </b>
            Backoffice
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a class="sidebar-toggle" data-toggle="push-menu" href="#" role="button">
            <span class="sr-only">
                Toggle navigation
            </span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <img alt="User Image" class="user-image" src="{{ asset(Auth::user()->image_file)}}">
                            <span class="hidden-xs">
                                {{Auth::user()->name}}
                            </span>
                        </img>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img alt="User Image" class="img-circle" src="{{ asset(Auth::user()->image_file)}}">
                                <p>
                                    {{Auth::user()->name}}
                                </p>
                            </img>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a class="btn btn-default btn-flat" href="{{ route('backoffice.user.detail',Auth::user()->id) }}">
                                    Profile
                                </a>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-default btn-flat" href="{{ route('backoffice.logout') }}">
                                    <span class="fa fa-sign-out">
                                    </span>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>