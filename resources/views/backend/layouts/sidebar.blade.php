<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('assets/backend')}}/dist/img/AdminLTELogo.png" alt="{{ app_name() }}"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">

        <span class="brand-text font-weight-light">{{ app_name() }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}"
                       class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p> {{__('menus.backend.sidebar.dashboard')}} </p>
                    </a>
                </li>
                @can('Manage Users')
                    <li class="nav-item">
                        <a href="{{route('admin.front-user.index')}}"
                           class="nav-link {{ (request()->is('admin/front-user')) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p> Users </p>
                        </a>
                    </li>
                @endcan
                @can('Manage Global Modules')
                    <li class="nav-item has-treeview {{ (request()->is('admin/global-modules*')) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (request()->is('admin/global-modules*')) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-pie-chart"></i>
                            <p> {{__('menus.backend.sidebar.global_modules.title')}} <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('Manage Amenity')
                                <li class="nav-item">
                                    <a href="{{route('admin.global-modules.amenity.index')}}"
                                       class="nav-link {{ (request()->is('admin/global-modules/amenity*')) ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Amenity</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Property Type')
                                <li class="nav-item">
                                    <a href="{{route('admin.global-modules.property-type.index')}}"
                                       class="nav-link {{ (request()->is('admin/global-modules/property-type*')) ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>{{__('menus.backend.sidebar.global_modules.property_type')}}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Package Facility')
                                <li class="nav-item">
                                    <a href="{{route('admin.global-modules.package-facility.index')}}"
                                       class="nav-link {{ (request()->is('admin/global-modules/package-facility*')) ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>{{__('menus.backend.sidebar.global_modules.package_facility')}}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Package')
                                <li class="nav-item">
                                    <a href="{{route('admin.global-modules.package.index')}}"
                                       class="nav-link {{ (request()->is('admin/global-modules/package*')) ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>{{__('menus.backend.sidebar.global_modules.package')}}</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Address')
                                <li class="nav-item">
                                    <a href="{{route('admin.global-modules.country.index')}}"
                                       class="nav-link {{ (request()->is('admin/global-modules/country*')) ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Address</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Testimonial')
                                <li class="nav-item">
                                    <a href="{{route('admin.global-modules.testimonial.index')}}"
                                       class="nav-link {{ (request()->is('admin/global-modules/testimonial*')) ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Testimonial</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Page')
                                <li class="nav-item">
                                    <a href="{{  route('admin.global-modules.page.index') }}"
                                       class="nav-link {{ (request()->is('admin/global-modules/page*')) ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Page</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Manage Career')
                                <li class="nav-item">
                                    <a href="{{  route('admin.global-modules.career.index') }}"
                                       class="nav-link {{ (request()->is('admin/global-modules/career*')) ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Career</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Building')
                <li class="nav-item has-treeview {{ (request()->is('admin//building*')) ? 'menu-open' : '' }}">
                    <a href="javascript:void(0);"
                       class="nav-link {{ (request()->is('admin/building*')) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-pie-chart"></i>
                        <p>Building<i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('Manage Building')
                            <li class="nav-item">
                                <a href="{{  route('admin.global-modules.building.index') }}"
                                   class="nav-link {{ (request()->is('admin/building*')) ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Building</p>
                                </a>
                            </li>
                        @endcan
                        @can('Manage Unverified Building')
                            <li class="nav-item">
                                <a href="{{  route('admin.global-modules.unverified.building') }}"
                                   class="nav-link {{ (request()->is('admin/unverified-building*')) ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Unverified Building</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('Links')
                <li class="nav-item has-treeview {{ (request()->is('admin/link*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/link*')) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-pie-chart"></i>
                        <p>Links<i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('Manage Header Link')
                            <li class="nav-item">
                                <a href="{{route('admin.link.header-link.index')}}"
                                   class="nav-link {{ (request()->is('admin/link/header-link*')) ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-dashboard"></i>
                                    <p> Header Link </p>
                                </a>
                            </li>
                        @endcan
                        @can('Manage Footer Link')
                            <li class="nav-item">
                                <a href="{{route('admin.link.footer-link.index')}}"
                                   class="nav-link {{ (request()->is('admin/link/footer-link*')) ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Footer Link</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @if(auth()->user()->is_superadmin == 1 || auth()->user()->can('Back Users'))
                    <li class="nav-item has-treeview {{ (request()->is('admin/admin-user*')) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (request()->is('admin/admin-user*')) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-pie-chart"></i>
                            <p> Back User <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(auth()->user()->is_superadmin == 1 || auth()->user()->can('Manage Admin User'))
                                <li class="nav-item">
                                    <a href="{{route('admin.admin-user.index')}}"
                                       class="nav-link {{ (request()->is('admin/admin-user')) ? 'active' : '' }}">
                                        <i class="nav-icon fa fa-dashboard"></i>
                                        <p> Admin Users </p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->is_superadmin == 1 || auth()->user()->can('Manage Role'))
                                <li class="nav-item">
                                    <a href="{{route('admin.user.role.index')}}"
                                       class="nav-link {{ (request()->is('admin/user/role*')) ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Role</p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->is_superadmin == 1 || auth()->user()->can('Manage Permission'))
                                <li class="nav-item">
                                    <a href="{{route('admin.user.permission.index')}}"
                                       class="nav-link {{ (request()->is('admin/user/permission*')) ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Permission</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @can('Properties')
                <li class="nav-item has-treeview {{ (request()->is('admin/properties*')) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/properties*')) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-pie-chart"></i>
                        <p> Property <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @can('Manage Properties')
                                <a href="{{route('admin.property.index')}}"
                                   class="nav-link {{ (request()->is('admin/properties')) ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Properties</p>
                                </a>
                            @endcan
                            @can('Manage Unverified Properties')
                                <a href="{{route('admin.property.unverified.property-list')}}"
                                   class="nav-link {{ (request()->is('admin/properties/unverified-list')) ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Unverified Properties</p>
                                </a>
                            @endcan
                            @can('Manage Unapproved Properties')
                                <a href="{{route('admin.property.unapproved.property-list')}}"
                                   class="nav-link {{ (request()->is('admin/properties/unapproved-list')) ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Unapproved Properties</p>
                                </a>
                            @endcan
                        </li>
                    </ul>
                </li>
                @endcan
                @can('Manage Projects')
                    <li class="nav-item has-treeview {{ (request()->is('admin/project*')) ? 'menu-open' : '' }}">
                        <a href="javascript:void(0);"
                           class="nav-link {{ request()->routeIs('admin.project*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-pie-chart"></i>
                            <p> Projects <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.project.index')}}"
                                   class="nav-link {{ request()->routeIs('admin.project*') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-pie-chart"></i>
                                    <p>Projects List</i>
                                    </p>
                                </a>
                                <a href="{{ route('admin.unapproved-project')}}"
                                   class="nav-link {{ \Request::route()->getName() == 'admin.unapproved-project' ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-pie-chart"></i>
                                    <p>Unapproved Projects</i>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
