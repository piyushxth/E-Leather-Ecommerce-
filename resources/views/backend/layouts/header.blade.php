<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
        </li>

    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            @include('backend.pages.notification.show')
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-cog mr-2"></i>Setting
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.setting.index') }}" class="dropdown-item">
                    <i class="fas fa-cog mr-2"></i>Setting
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.show_password_reset_form') }}" class="dropdown-item">
                    <i class="fas fa-cog mr-2"></i>Change Password
                </a>
                <div class="dropdown-divider"></div>

                <form id="logout-form" action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item"> <i
                            class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                </form>
                <div class="dropdown-divider"></div>

            </div>
        </li>

    </ul>
</nav>
