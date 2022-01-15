<!-- sidebar @s -->
<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
  <div class="nk-sidebar-element nk-sidebar-head">
      <div class="nk-sidebar-brand">
        <a href="/" class="logo-link nk-sidebar-logo">
          <img class="logo-light logo-img" src="{{asset('admin/images/logo.png')}}" srcset="{{asset('admin/images/logo2x.png')}} 2x" alt="logo">
          <img class="logo-dark logo-img" src="{{asset('admin/images/logo-dark.png')}}" srcset="{{asset('admin/images/logo-dark2x.png')}} 2x" alt="logo-dark">
          <img class="logo-small logo-img logo-img-small" src="{{asset('admin/images/logo-small.png')}}" srcset="{{asset('admin/images/logo-small2x.png')}} 2x" alt="logo-small">
         
      </a>
      </div>
      <div class="nk-menu-trigger mr-n2">
          <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
          <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
      </div>
  </div><!-- .nk-sidebar-element -->
  <div class="nk-sidebar-element">
      <div class="nk-sidebar-content">
          <div class="nk-sidebar-menu" data-simplebar>
              <ul class="nk-menu">
                 
                  <li class="nk-menu-heading">
                      <h6 class="overline-title text-primary-alt">Dashboards</h6>
                  </li><!-- .nk-menu-item -->
                  <li class="nk-menu-item">
                      <a href="/user/dashboard" class="nk-menu-link">
                          <span class="nk-menu-icon"><em class="icon ni ni-grid-alt-fill"></em></span>
                          <span class="nk-menu-text"> Dashboard </span>
                      </a>
                  </li><!-- .nk-menu-item -->
                  
                  <li class="nk-menu-item has-sub">
                      <a href="#" class="nk-menu-link nk-menu-toggle">
                          <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                          <span class="nk-menu-text">Subscription Peckage</span>
                      </a>
                      <ul class="nk-menu-sub">
                          <li class="nk-menu-item">
                              <a href="{{url('user/subscription')}}" class="nk-menu-link"><span class="nk-menu-text">Package </span></a>
                          </li>
                      </ul><!-- .nk-menu-sub -->
                  </li><!-- .nk-menu-item -->
                  @php
                    $auth_user = Auth::user();
                  @endphp
                  @if($auth_user->p_subscription)
                  @if($auth_user->p_subscription->affiliate == 'Yes')
                  <li class="nk-menu-item has-sub">
                      <a href="{{url('user/withdraws')}}" class="nk-menu-link nk-menu-toggle">
                          <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb-fill"></em></span>
                          <span class="nk-menu-text">Withdraw Requests</span>
                      </a>
                      <ul class="nk-menu-sub">
                          <li class="nk-menu-item">
                              <a href="{{url('user/withdraws')}}" class="nk-menu-link"><span class="nk-menu-text">All Requests</span></a>
                          </li>
                          <li class="nk-menu-item">
                              <a href="{{url('user/new_withdraws')}}" class="nk-menu-link"><span class="nk-menu-text">New Requests</span></a>
                          </li>
                      </ul><!-- .nk-menu-sub -->
                  </li><!-- .nk-menu-item -->
                  @endif
                  @endif

                  <li class="nk-menu-item">
                      <a href="{{url('user/product')}}" class="nk-menu-link">
                          <span class="nk-menu-icon"><em class="icon ni ni-menu-circled"></em></span>
                          <span class="nk-menu-text">Software Library</span>
                      </a>
                  </li><!-- .nk-menu-item -->
                  <li class="nk-menu-item">
                      <a href="{{url('user/video')}}" class="nk-menu-link">
                          <span class="nk-menu-icon"><em class="icon ni ni-menu-circled"></em></span>
                          <span class="nk-menu-text">Video Library</span>
                      </a>
                  </li><!-- .nk-menu-item -->

                  
                  <li class="nk-menu-item">
                      <a href="{{url('user/accounts')}}" class="nk-menu-link">
                          <span class="nk-menu-icon"><em class="icon ni ni-user-check-fill"></em></span>
                          <span class="nk-menu-text">My Account Numbers</span>
                      </a>
                  </li><!-- .nk-menu-item -->
                  <li class="nk-menu-item">
                      <a href="/forums" class="nk-menu-link">
                          <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                          <span class="nk-menu-text">Forum</span>
                      </a>
                  </li><!-- .nk-menu-item -->
                  <li class="nk-menu-item">
                      <a href="{{url('group_chat')}}" class="nk-menu-link">
                          <span class="nk-menu-icon"><em class="icon ni ni-user-check-fill"></em></span>
                          <span class="nk-menu-text">Group Chat</span>
                      </a>
                  </li>
                  <li class="nk-menu-item">
                      <a href="{{url('group_meetings')}}" class="nk-menu-link">
                          <span class="nk-menu-icon"><em class="icon ni ni-user-check-fill"></em></span>
                          <span class="nk-menu-text">Live Trading Room</span>
                      </a>
                  </li>
              </ul><!-- .nk-menu -->
          </div><!-- .nk-sidebar-menu -->
      </div><!-- .nk-sidebar-content -->
  </div><!-- .nk-sidebar-element -->
</div>
<!-- sidebar @e -->
