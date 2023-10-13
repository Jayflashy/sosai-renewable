<div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1" aria-labelledby="affanOffcanvsLabel">
    <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    <div class="offcanvas-body p-0">
      <!-- Side Nav Wrapper -->
      <div class="sidenav-wrapper">
        <!-- Sidenav Profile -->
        <div class="sidenav-profile bg-success">
          <div class="sidenav-style1"></div>
          <!-- User Info -->
          <div class="user-info">
            <h4 class="user-name mb-0">{{Auth::user()->name}}</h4>
            <span>Balance: {{format_price(Auth::user()->balance)}}</span> <br>
          </div>
        </div>
        <!-- Sidenav Nav -->
        <ul class="sidenav-nav ps-0">
          <li><a href="{{route('app.user.dashboard')}}"><i class="bi bi-house-door"></i>Dashboard</a></li>
          <li><a href="{{route('app.user.payment')}}"><i class="fa fa-wallet"></i>Meter Payment</a></li>
          <li><a href="{{route('app.user.wallet')}}"><i class="bi bi-bank"></i>Fund Account</a></li>
          <li><a href="#"><i class="fa fa-money-bill"></i>Reports</a>
            <ul>
              <li><a href="{{route('app.user.deposits')}}">Deposit History</a></li>

              <li><a href="{{route('app.user.transactions')}}">Transaction History</a></li>
            </ul>
          </li>
          <li>
            <div class="night-mode-nav">
              <i class="bi bi-moon"></i>Night Mode
              <label class="jdv-switch2 jdv-switch-success ms-auto">
                <input type="checkbox" id="darkSwitch">
                <span class="slider round"></span>
              </label>
            </div>
          </li>
          <li><a href="{{route('logout')}}"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
        </ul>
      </div>
    </div>
</div>
