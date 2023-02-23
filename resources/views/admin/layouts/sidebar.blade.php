<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (auth('admin')->user()->type === 'admin' && auth('admin')->user()->status === 1)
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#admin-management" aria-expanded="false"
                    aria-controls="admin-management">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">Admins</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="admin-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('view.admin') }}">View Admins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('add-edit.admin') }}">Add Admin</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#category-management" aria-expanded="false"
                    aria-controls="category-management">
                    <i class="icon-columns menu-icon"></i>
                    <span class="menu-title">Categories</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="category-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/forms/basic_elements.html">View Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/forms/basic_elements.html">Add Category</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#product-management" aria-expanded="false"
                    aria-controls="product-management">
                    <i class="icon-columns menu-icon"></i>
                    <span class="menu-title">Products</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="product-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/forms/basic_elements.html">View Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/forms/basic_elements.html">Add Product</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#cupon-management" aria-expanded="false"
                    aria-controls="cupon-management">
                    <i class="icon-bar-graph menu-icon"></i>
                    <span class="menu-title">Coupons</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="cupon-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/charts/chartjs.html">View Cupons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/charts/chartjs.html">Add Cupon</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#user-management" aria-expanded="false"
                    aria-controls="user-management">
                    <i class="icon-bar-graph menu-icon"></i>
                    <span class="menu-title">Users</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="user-management">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/charts/chartjs.html">View Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/charts/chartjs.html">Add User</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Payments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Orders</span>
                </a>
            </li>
        @endif

        @if (auth('admin')->user()->type === 'vendor')

        @endif

        {{-- need to remove --}}
        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">Tables</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li> --}}
    </ul>
</nav>
