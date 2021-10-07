<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu" class="m-2">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('home')}}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('customer.index')}}" class="waves-effect">
                        <i class="mdi mdi-account"></i>
                        <span>Customer</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('employee.index')}}" class="waves-effect">
                        <i class="mdi mdi-account"></i>
                        <span>Employee</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('appointment.index')}}" class="waves-effect">
                        <i class="mdi mdi-watch"></i>
                        <span>Appointment</span>
                    </a>
                </li>
                <li class="menu-title">Service management</li>
                <li><a href="{{route('service.index')}}"><i class="fab fa-product-hunt"></i> Services</a></li>
                <li class="menu-title">Product management</li>
                <li><a href="{{route('attribute.index')}}"><i class="fab fa-product-hunt"></i>Attribute</a></li>
                <li><a href="{{route('product.index')}}"><i class="fab fa-product-hunt"></i> Product</a></li>
                <li class="menu-title">Invoice management</li>
                <li>
                    <a href="{{route('invoice.index')}}" class="waves-effect">
                        <i class="fas fa-file-invoice"></i>
                        <span>Customer Invoice</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('sellerinvoice.index')}}" class="waves-effect">
                        <i class="fas fa-file-invoice"></i>
                        <span>Seller Invoice</span>
                    </a>
                </li>

                <li class="menu-title">Settings</li>
                <li>
                    <a href="{{route('setting.index')}}" class="waves-effect">
                        <i class="fa fa-cog"></i>
                        <span>General Setting</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('expense.index')}}" class="waves-effect">
                        <i class="mdi mdi-cash-100"></i>
                        <span>Expenses</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('report.index')}}" class="waves-effect">
                        <i class="mdi mdi-cash-100"></i>
                        <span>Report</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
