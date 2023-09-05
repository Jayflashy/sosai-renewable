<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('admin.index')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title">users</li>
                <li>
                    <a href="{{route('admin.agents.index')}}" class=" waves-effect">
                        <i class="fa fa-user"></i>
                        <span>All Agents</span>
                    </a>
                </li> 
                <li>
                    <a href="{{route('admin.users.index')}}" class=" waves-effect">
                        <i class="fa fa-users"></i>
                        <span>All Users</span>
                    </a>
                </li> 
                <li>
                    <a href="{{route('admin.users.pending')}}" class=" waves-effect">
                        <i class="fa fa-user"></i>
                        <span>Pending Users</span>
                    </a>
                </li> 
                <li class="menu-title">Meter Section</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-text-line"></i>
                        <span>Angaza API</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        {{-- <li><a href="{{route('admin.angaza.overview')}}">Overview</a></li> --}}
                        <li><a href="{{route('admin.angaza.customers')}}">Customers</a></li>
                        <li><a href="{{route('admin.angaza.meters')}}">Accounts</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-text-line"></i>
                        <span>Steamaco API</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('admin.steamaco.overview')}}">Overview</a></li>
                        <li><a href="{{route('admin.steamaco.customers')}}">Customers</a></li>
                        <li><a href="{{route('admin.steamaco.meters')}}">Meters</a></li>
                    </ul>
                </li>
                <li class="menu-title">Payments</li>
                <li>
                    <a href="{{route('admin.deposits')}}" class=" waves-effect">
                        <i class="fas fa-money-bill"></i>
                        <span>Deposit History</span>
                    </a>
                </li> 
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-text-line"></i>
                        <span>Transactions</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('admin.transactions')}}">All Transactions</a></li>
                        <li><a href="{{route('admin.transactions.angaza')}}">Angaza Transactions</a></li>
                        <li><a href="{{route('admin.transactions.steama')}}">Steamaco Transactions</a></li>
                    </ul>
                </li>

                <li class="menu-title">Settings</li>                
                <li>
                    <a href="{{route('admin.settings.api')}}" class=" waves-effect">
                        <i class="fas fa-cog"></i>
                        <span>API Setting</span>
                    </a>
                </li> 
                <li>
                    <a href="{{route('admin.settings.index')}}" class=" waves-effect">
                        <i class="fas fa-cog"></i>
                        <span>General Settings</span>
                    </a>
                </li>  
                <li>
                    <a href="{{route('admin.settings.payment')}}" class=" waves-effect">
                        <i class="fas fa-wallet"></i>
                        <span>Payment Setting</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->