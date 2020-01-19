<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown" style="width: 170px">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <div class="user-panel image" style="position: absolute;overflow: -moz-scrollbars-none; left: -23px">
                    <img src="{{ loggedUser()->profile_image_url }}"
                         class="img-circle elevation-2" alt="User Image">
                </div>
                <div style="margin-top: 5px">
                    <span>{{ loggedUser()->name }}</span>
                    <i class="right fa fa-angle-down"></i>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <i class="fa fa-user-circle-o mr-2"></i> My Profile
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-key mr-2"></i> Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.auth.logout') }}" class="dropdown-item"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock mr-2"></i> Logout
                    <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </a>
                <div class="dropdown-divider"></div>
                {{--                <a class="nav-link" href="{{ route('admin.auth.logout') }}"--}}
                {{--                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
                {{--                    Logout--}}

                {{--                </a>--}}
            </div>
        </li>
        <li class="nav-item">

        </li>
    </ul>
</nav>
<!-- /.navbar -->
