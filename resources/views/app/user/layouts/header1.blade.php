<div class="header-area" id="headerArea">
    <div class="container">
      <!-- Header Content -->
      <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
        <!-- Back Button -->
        <div class="back-button"><a href="javascript:history.back()">
            <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
            </svg></a>
        </div>
        <div class="page-heading">
            <h6 class="mb-0">@yield('title')</h6>
        </div>
        <div class="setting-wrapper">
            <div class="setting-trigger-btn" id="settingTriggerBtn" onclick="openLink('{{route('app.agent.transactions')}}')">
                <i class="far fa-bell"></i><span></span>
            </div>
        </div>
      </div>
      <!-- # Header Five Layout End -->
    </div>
</div>
