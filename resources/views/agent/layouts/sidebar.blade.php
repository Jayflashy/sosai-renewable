<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('agent.dashboard')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('agent.profile')}}" class=" waves-effect">
                        <i class="fa fa-user-cog"></i>
                        <span>Account Settings</span>
                    </a>
                </li>
                <li class="menu-title">Payment</li>
                <li>
                    <a href="{{route('agent.wallet')}}" class=" waves-effect">
                        <i class="fa fa-money-bill"></i>
                        <span>Deposit Money</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('agent.payment')}}" class=" waves-effect">
                        <i class="fas fa-wallet"></i>
                        <span>Make Payment</span>
                    </a>
                </li>

                <li class="menu-title">transactions</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-text-line"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('agent.deposits')}}">Deposit History</a></li>
                        <li><a href="{{route('agent.transactions')}}">Transaction History</a></li>
                    </ul>
                </li>
                <li class="menu-title">Account</li>
                <li>
                    <a href="{{route('logout')}}" class=" waves-effect">
                        <i class="fa fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
