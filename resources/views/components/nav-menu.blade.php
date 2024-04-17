<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
with font-awesome or any other icon font library -->
        @foreach($items as $item)
            <li class="nav-item menu-open">
                <a href="" class="nav-link {{ Route::is($item['active']) ? 'active' : '' }}">
                    <i class="{{ $item['icon'] }}"></i>
                    <p>
                        {{ $item['title'] }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                @foreach($item['links'] as $link)
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route($link['route'] ?? 'dashboard.index')}}" class="nav-link {{ Route::is($link['route']) ? 'active' : '' }}">
                                <i class="{{ $link['icon'] }}"></i>
                                <p>{{ $link['title'] }}
                                    @if($link['badge'] ?? false)
                                        <span class="right badge badge-danger">{{ $link['badge'] }}</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                    </ul>
                @endforeach
            </li>
        @endforeach
{{--        <li class="nav-item">--}}
{{--            <a href="#" class="nav-link">--}}
{{--                <i class="nav-icon fas fa-th"></i>--}}
{{--                <p>--}}
{{--                    Simple Link--}}
{{--                    <span class="right badge badge-danger">New</span>--}}
{{--                </p>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
</nav>
<!-- /.sidebar-menu -->
