
<aside id="sidebar" class='light-mode'>
    <div class="d-flex">
        <button id="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#">Admin</a>
        </div>
    </div>
    {{-- <!-- إضافة الشعار هنا -->
    <div class="sidebar-logo">
        <a href="#">
            <img src="{{ asset('images/bus.jpg') }}" alt="Logo" class="img-fluid" />
        </a>
    </div> --}}
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('supervisors.index') }}" class="sidebar-link {{ request()->routeIs('supervisors.index') ? 'active' : '' }}">
                <i class="lni lni-consulting"></i>
                <span>المشرفين</span>
            </a>
            {{-- <ul class="sidebar-submenu">
                <li class="sidebar-item">
                    <a href="{{ route('supervisors.create') }}" class="sidebar-link {{ request()->routeIs('supervisors.create') ? 'active' : '' }}">
                    
                        <span>اضافة مشرف</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ request()->routeIs('supervisors.edit') ? 'active' : '' }}">
                        <span>تعديل مشرف</span>
                    </a>
                </li>                        
            </ul> --}}
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('employee') ? 'active' : '' }}">
                <span></span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('sections.index') }}" class="sidebar-link {{ request()->routeIs('sections.*') ? 'active' : '' }}">
                <i class="lni lni-travel"></i>
                <span>الافرع</span>
            </a>
            {{-- <ul class="sidebar-submenu">
                <li class="sidebar-item">
                    <a href="{{ route('sections.create') }}" class="sidebar-link {{ request()->routeIs('sections.create') ? 'active' : '' }}">
                        <span>اضافة فرع</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ request()->routeIs('sections.edit') ? 'active' : '' }}">
                        <span>تعديل فرع</span>
                    </a>
                </li>     
            </ul> --}}
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('employee') ? 'active' : '' }}">
                <span></span>
            </a>
        </li>
        <li class="sidebar-item">

            <a href="{{ route('transport.index') }}" class="sidebar-link {{ request()->routeIs('transport.*') ? 'active' : '' }}">

                <i class="lni lni-car-alt"></i>
                <span>وسائل النقل</span>
            </a>
            {{-- <ul class="sidebar-submenu">
                <li class="sidebar-item">
                    <a href="{{ route('sections.create') }}" class="sidebar-link {{ request()->routeIs('transport.create') ? 'active' : '' }}">
                        <span>اضافة وسيلة نقل</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ request()->routeIs('transport.edit') ? 'active' : '' }}">
                        <span>تعديل وسيلة نقل</span>
                    </a>
                </li>     
            </ul> --}}
        </li>  
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('employee') ? 'active' : '' }}">
                <span></span>
            </a>
        </li>
        <li class="sidebar-item">

            <a href="{{ route('employees.index') }}" class="sidebar-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                <i class="lni lni-user"></i>
                <span>الموظفين</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('employee') ? 'active' : '' }}">
                <span></span>
            </a>
        </li>
        <li class="sidebar-item">

            <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="lni lni-users"></i>
                <span>المستخدمين</span>
            </a>
        </li>  
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('employee') ? 'active' : '' }}">
                <span></span>
            </a>
        </li>            
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('requests*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#requerment" aria-expanded="false" aria-controls="requerment">
                <i class="lni lni-text-align-justify"></i>
                <span class="sidebar-text">الطلبات</span>
            </a>
            <ul class="sidebar-submenu">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ request()->is('requests/employment') ? 'active' : '' }}">
                        {{-- <i class="lni lni-chevron-right"></i> --}}
                        <span class="sidebar-text">طلبات التوظيف</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link {{ request()->is('requests/reject') ? 'active' : '' }}">
                        {{-- <i class="lni lni-chevron-right"></i> --}}
                        <span class="sidebar-text">طلبات الاستقالة</span>
                    </a>
                </li>
            </ul>
        </li>                              
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('employee') ? 'active' : '' }}">
                <span></span>
            </a>
        </li>         
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('records') ? 'active' : '' }}">
                <i class="lni lni-files"></i>
                <span>السجلات</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('employee') ? 'active' : '' }}">
                <span></span>
            </a>
        </li>
        <li class="sidebar-item">

            <a href="{{ route('complaints.index') }}" class="sidebar-link {{ request()->routeIs('complaints.*') ? 'active' : '' }}">
                <i class="lni lni-warning"></i>
                <span>قائمة الشكاوي</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('employee') ? 'active' : '' }}">
                <span></span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link {{ request()->is('notifications') ? 'active' : '' }}">
                <i class="lni lni-popup"></i>
                <span>اشعارات</span>
            </a>
        </li>
    </ul>
    <li class="sidebar-item">
        <a href="#" class="sidebar-link {{ request()->is('employee') ? 'active' : '' }}">
            <span></span>
        </a>
    </li>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <span style="color: black solid">-------</span>
        </a>
    </div>
</aside>