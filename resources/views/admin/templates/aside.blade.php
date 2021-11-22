<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://ui-avatars.com/api/?name={{ \Auth::user()->name }}" class="img-circle"
                    alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ \Auth::user()->username }}</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            {{-- <li class="header">HEADER</li> --}}
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
            {{-- <li><a href="#"><i class="fa fa-users"></i> <span>Pegawai</span></a></li> --}}
            <li class="treeview {{ (request()->is('master*')) ? 'active' : '' }}">
                <a href="#"><i class="fa fa-list"></i> <span>Master</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu menu-open">
                    <li><a href="#"><i class="fa fa-users"></i> Pegawai</a></li>
                    <li class="{{ (request()->is('master/jabatan*')) ? 'active' : '' }}"><a href="{{ route('jabatan') }}"><i class="fa fa-key"></i> Jabatan</a></li>
                    <li class="{{ (request()->is('master/unit-kerja*')) ? 'active' : '' }}"><a href="{{ route('unit-kerja') }}"><i class="fa fa-building-o"></i> Unit Kerja</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
