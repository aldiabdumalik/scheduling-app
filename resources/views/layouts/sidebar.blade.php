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
                <img src="{{asset('files/avatar/default.jpg')}}" alt="user-img" title="p" class="rounded-circle img-fluid">
            </div>
            <h5>
                <a href="#">
                    {{auth()->user()->load('employee')->employee->name}}
                </a>
            </h5>
            <p class="text-muted">
                {{auth()->user()->load('employee')->employee->nik}}
            </p>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i class="fi-air-play"></i> <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="fi-grid-2"></i> <span> Schedule </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{route('admin.event')}}">Event</a></li>
                        <li><a href="{{route('admin.picket')}}">Picket</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="fi-head"></i> <span> User </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{route('admin.employee')}}">Employee</a></li>
                        <li><a href="{{route('admin.user')}}">User</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="fi-cog"></i> <span> Master </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{route('logout')}}">Color</a></li>
                        <li><a href="{{route('logout')}}">Quote</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>