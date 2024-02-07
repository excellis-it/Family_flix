<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                <li class="{{ Request::is('admin/dashboard*') ? 'active' : ' ' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li class="submenu">
                    <a href="#"
                        class="{{ Request::is('admin/profile*') || Request::is('admin/password*') || Request::is('admin/detail*') ? 'active' : ' ' }}"><i
                            class="la la-user-cog"></i> <span>Manage Account </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ Request::is('admin/profile*') ? 'active' : ' ' }}">
                            <a href="{{ route('admin.profile') }}">My Profile</a>
                        </li>
                        <li class="{{ Request::is('admin/password*') ? 'active' : ' ' }}">
                            <a href="{{ route('admin.password') }}">Change Password</a>
                        </li>

                    </ul>
                </li>

                <li class="menu-title">
                    <span>Website Management</span>
                </li>
                <li class="submenu">
                    <a href="#" class="{{ Request::is('admin/menu-management*') ? 'active' : ' ' }}"><i class="la la-users"></i> <span>
                            Site Setting</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="{{ Request::is('admin/menu-management*') ? 'active' : ' ' }}">
                                <a href="{{ route('menu-management.index') }}">Menu Management</a>
                            </li>
                            <li class="{{ Request::is('admin/privacy-policy*') ? 'active' : ' ' }}">
                                <a href="{{ route('content-management.privacy-policy') }}">Privacy Policy</a>
                            </li>
                            {{-- <li class="{{ Request::is('admin/password*') ? 'active' : ' ' }}">
                                <a href="{{ route('admin.password') }}">Change Password</a>
                            </li> --}}
    
                        </ul>
                </li>
                <li class="menu-title">
                    <span>Plan Management</span>
                </li>
                <li class="{{ Request::is('admin/plan*') ? 'active' : ' ' }}">
                    <a href="{{ route('plan.index') }}"><i class="la la-plan"></i> <span>
                            Plan</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
