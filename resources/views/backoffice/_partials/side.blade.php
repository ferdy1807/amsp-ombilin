<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img alt="User Image" class="img-circle" src="{{ asset(Auth::user()->image_file)}}">
                </img>
            </div>
            <div class="pull-left info">
                <p>
                    {{Auth::user()->name}}
                </p>
                <a href="#">
                    <i class="fa fa-circle text-success">
                    </i>
                    Online
                </a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">
                MAIN NAVIGATION
            </li>
            @foreach($menus as $menu)
            @if (isset($menu['subs']) && count($menu['subs']) > 0)
            <li class="treeview">
                <a href="#">
                    <i class="{{ $menu['icon'] }}">
                    </i>
                    <span>
                        {{ $menu['menu'] }}
                    </span>
                    <i class="fa fa-angle-left pull-right">
                    </i>
                </a>
                <ul class="treeview-menu">
                    @foreach ($menu['subs'] as $sub)
                    <li>
                        <a href="{{ route($sub['code']) }}">
                            <i class="fa fa-angle-double-right">
                            </i>
                            {{ $sub['menu'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @else
            <li>
                <a href="{{ route($menu['code']) }}">
                    <i class="{{$menu['icon']}}">
                    </i>
                    <span>
                        {{ $menu['menu'] }}
                    </span>
                </a>
            </li>
            @endif
        @endforeach
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
