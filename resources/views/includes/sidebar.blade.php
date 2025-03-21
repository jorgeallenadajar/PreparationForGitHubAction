<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('ict_lib_dashboard') ? '' : 'collapsed' }} "
                href="{{ route('ict_lib_dashboard') }}">
                <!-- Tanggalin ang collapsed -->
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>


        @php
            $category = [
                'category_management' => Request::is('category_management'),
                'system_management' => Request::is('system_management'),
                'user_management' => Request::is('user_management'),
                'file_management' => Request::is('file_management'),

            ];



        @endphp
        <!-- {{ in_array(true, $category) ? 'collpased' : '' }} -->

        <li class="nav-item">
            <a class="nav-link {{ in_array(true, $category) ? '' : 'collapsed' }}" data-bs-target="#icons-nav"
                data-bs-toggle="collapse" href="">
                <i class="bi bi-gem"></i><span>Management</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse {{ in_array(true, $category) ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <!-- Lagay collapse show -->


                <li>
                    <a href="{{ route('file_management') }}"
                        class="{{ Request::is('file_management') ? 'active' : '' }}">
                        <!-- Lagay active -->
                        <i class="bi bi-circle"></i><span>Files</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category_management') }}"
                        class="{{ Request::is('category_management') ? 'active' : '' }}">
                        <!-- Lagay active -->
                        <i class="bi bi-circle"></i><span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('system_management') }}"
                        class="{{ Request::is('system_management') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Systems</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user_management') }}"
                        class="{{ Request::is('user_management') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Users</span>
                    </a>
                </li>

            </ul>





            <!-- user_management -->
        </li>
        <!-- End Icons Nav -->

        <li hidden class="nav-heading">Pages</li>


    </ul>

</aside>