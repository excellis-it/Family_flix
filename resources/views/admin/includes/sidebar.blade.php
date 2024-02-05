<div class="main-sidebar sidebar-style-2" tabindex="1">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}"><span class="logo-name"></span>Family-Flix </a>
        </div>
        <ul class="sidebar-menu ">
            <li class="menu-header"></li>
            <li class="dropdown {{ Request::is('admin/dashboard*') ? 'active' : ' ' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="ph ph-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Product Management</li>

            <li class="">
                <a href="">
                    <i class="ph-users"></i>
                    <span>Products</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
