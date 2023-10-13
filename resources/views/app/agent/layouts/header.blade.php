<div class="header-area" id="headerArea">
    <div class="container">
      <!-- Header Content -->
      <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
        <!-- Logo -->
        <div class="logo-wrapper"><a href="{{route('app.agent.dashboard')}}"><img src="{{my_asset(get_setting('logo'))}}" alt=""></a></div>
        <div class="setting-wrapper">
            <div class="setting-trigger-btn" id="settingTriggerBtn" onclick="openLink('{{route('app.agent.transactions')}}')">
                <i class="far fa-bell"></i><span></span>
            </div>
        </div>
      </div>
      <!-- # Header Five Layout End -->
    </div>
</div>
