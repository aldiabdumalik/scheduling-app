<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!-- LOGO -->
        <div class="topbar-left">
            <a href="#" class="logo">
                <span>
                    <img src="{{asset('templates/assets/images/laravel.svg')}}" alt="" height="35">
                </span>
                <i>
                    <img src="{{asset('templates/assets/images/laravel.svg')}}" alt="" height="28">
                </i>
            </a>
        </div>
        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img src="{{asset('assets/uploads/user_photos/')}}/{{auth()->user()->photo}}" alt="user-img" title="{{auth()->user()->name}}" class="rounded-circle img-fluid">
            </div>
            <h5>
                <a href="#">
                    {{explode(" ",auth()->user()->name)[0]}} {{explode(" ",auth()->user()->name)[1]}}
                </a>
            </h5>
            <p class="text-muted">{{auth()->user()->level}}</p>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="fi-air-play"></i> <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="fi-folder"></i> <span> Master </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{route('users')}}">Users</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>