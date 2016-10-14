
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo histo-link">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>WheelsMada</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>WheelsMada</b> <br> <h2>Administration</h2></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ Helper::gravatar( session('email') ) }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ session('username') }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ Helper::gravatar( session('email')) }}" class="img-circle" alt="User Image">

                                <p>
                                    {{ session('username') }} - {{ session('role') }}
                                    <!--small>Member since Nov. 2012</small-->
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('gstion/admin/profile/'.str_replace(' ','', session('username'))) }}" class="btn btn-default btn-flat histo-link">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('gstion/admin/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
