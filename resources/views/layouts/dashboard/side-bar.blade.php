<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Project App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src='{{ asset('img/' . auth()->user()->img) }}' class="img-circle elevation-2" alt="User Image"
                    style="height: 2rem;width: 2rem;" />
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                <a href="#" class="d-block">({{ Auth::user()->occupation->name }})</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search" />
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                {{-- Home --}}
                <li class="nav-item">
                    <a href="/home" class="nav-link" data-page="home">
                        <i class="fas fa-home nav-icon"></i>

                        <p>Home</p>
                    </a>
                </li>
                {{-- End Home --}}

                {{-- Project --}}
                <li class="nav-header d-flex justify-content-between">Project
                    @if (auth()->user()->occupation_id == 2)
                    <a href="/project/create">
                        <div class="icon"><i class="nav-icon fas fa-plus"></i></div>
                    </a>
                    @endif
                </li>
                @if (Auth::user()->division_id != 1)
                <li class="nav-item">
                    <a href="/task-list" class="nav-link" data-page="task-list">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Tugas
                        </p>
                    </a>
                </li>
                @endif
                {{-- End Project --}}


                {{-- Project List --}}

                <li class="nav-item helper-dropdown">
                    <a href="#" class="nav-link" data-page='project'>
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Project List
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($projects as $item)
                        <li class="nav-item">
                            <a href="/project/{{ $item->id }}" class="nav-link" data-page='{{ $item->id }}'>
                                <i class="far fa-circle nav-icon"></i>

                                <p>{{ $item->name }}</p>
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </li>
                {{-- End Project List --}}


                {{-- Master Data --}}
                <li class="nav-header">Master Data</li>
                <li class="nav-item">
                    <a href="/data-project" class="nav-link" data-page='data-project'>
                        <i class="nav-icon fas fa-braille"></i>
                        <p>
                            Project
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="/data-task" class="nav-link" data-page='data-task'>
                        <i class="nav-icon fas fa-braille"></i>
                        <p>
                            Task
                        </p>
                    </a>
                </li> --}}
                {{-- End Master Data --}}

                {{-- Master data divisi --}}
                <li class="nav-item">
                    <a href="/data-division" class="nav-link" data-page='data-division'>
                        <i class="nav-icon fas fa-braille"></i>
                        <p>
                            Division
                        </p>
                    </a>
                </li>

                {{-- Master data user --}}
                <li class="nav-item">
                    <a href="/data-user" class="nav-link" data-page='data-user'>
                        <i class="nav-icon fas fa-braille"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>

                <li class="nav-header">Profile</li>
                <li class="nav-item">
                    <a href="/profile/{{ Auth::user()->id }}" class="nav-link" data-page="profile">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>
                            My Profile
                        </p>
                    </a>
                </li>

                {{-- End master data divisi --}}
                {{-- Log Out --}}
                <li class="nav-header">Log out</li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link" onclick="$('#logout-form').submit()">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Log Out
                        </p>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
