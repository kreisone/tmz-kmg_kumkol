<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-tachometer-alt"></i> &nbsp;&nbsp;@lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            <li class="nav-title">
                @lang('menus.backend.sidebar.system')
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/auth*')) }}" href="#">
                        <i class="fas fa-users"></i> &nbsp;@lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/config*')) }}" href="{{ route('admin.auth.config.index') }}">
                                @lang('labels.backend.access.config.title')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="divider"></li>

                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/log-viewer*')) }}" href="#">
                        <i class="fas fa-list-alt"></i> &nbsp;&nbsp;@lang('menus.backend.log-viewer.main')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer')) }}" href="{{ route('log-viewer::dashboard') }}">
                                @lang('menus.backend.log-viewer.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}" href="{{ route('log-viewer::logs.list') }}">
                                @lang('menus.backend.log-viewer.logs')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @role('service_of_security')
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/service_of_security*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/service_of_security/statistics*')) }}" href="#">
                        <i class="fas fa-clipboard-list"></i> &nbsp;&nbsp;@lang('menus.backend.service_of_security.statistics.main')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/service_of_security/statistics/general*')) }}" href="{{ route('admin.auth.statistics.index') }}">
                                @lang('menus.backend.service_of_security.statistics.general')
                            </a>
                        </li>
                    </ul>
                </li>
            @endrole

            @role('pass_bureau')
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin*')) }}" href="#">
                        <i class="fas fa-list-alt"></i> &nbsp;&nbsp;@lang('menus.backend.pass_bureau.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/material*')) }}" href="{{ route('admin.auth.material.index') }}">
                                @lang('menus.backend.pass_bureau.materials.main')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/group_of_personnel*')) }}" href="{{ route('admin.auth.group_of_personnel.index') }}">
                                @lang('menus.backend.pass_bureau.group_of_personnel.main')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/shopfloor*')) }}" href="{{ route('admin.auth.shopfloor.index') }}">
                                @lang('menus.backend.pass_bureau.shopfloor.main')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/group_of_personnel*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/group_of_personnel*')) }}" href="#">
                        <i class="fas fa-directions"></i> &nbsp;&nbsp;@lang('menus.backend.pass_bureau.title_action')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/group_of_personnel/add_mat_to_group*')) }}" href="{{ route('admin.auth.group_of_personnel.add_mat_to_group.show') }}">
                                @lang('menus.backend.pass_bureau.group_of_personnel.add_mat_to_group')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/group_of_personnel/add_worker_to_group*')) }}" href="{{ route('admin.auth.group_of_personnel.add_worker_to_group.show') }}">
                                @lang('menus.backend.pass_bureau.group_of_personnel.add_worker_to_group')
                            </a>
                        </li>
                    </ul>
                </li>
            @endrole

            
        </ul>
    </nav>

    <!-- <button class="sidebar-minimizer brand-minimizer" type="button"></button> -->
</div><!--sidebar-->
