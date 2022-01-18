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
                        <a href="{{url('admin/home')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-grid-alt-fill"></em></span>
                            <span class="nk-menu-text"> Dashboard </span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">Users</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('admin/a_users')}}" class="nk-menu-link"><span class="nk-menu-text">User List </span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb-fill"></em></span>
                            <span class="nk-menu-text">Withdraw Requests</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('admin/withdraws')}}" class="nk-menu-link"><span class="nk-menu-text">All Requests</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('withdraws.types')}}" class="nk-menu-link"><span class="nk-menu-text">Withdraw Type</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('withdraws.types.add')}}" class="nk-menu-link"><span class="nk-menu-text">Add Withdraw Type</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                   
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                            <span class="nk-menu-text">Subscription</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('subscription.index')}}" class="nk-menu-link"><span class="nk-menu-text">Subscription List </span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('subscription.create')}}" class="nk-menu-link"><span class="nk-menu-text">Add Subscription</span></a>
                            </li>
                           
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-grid-alt-fill"></em></span>
                            <span class="nk-menu-text">Product Category</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('category.index')}}" class="nk-menu-link"><span class="nk-menu-text">Category list</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('category.create')}}" class="nk-menu-link"><span class="nk-menu-text">Add Category</span></a>
                            </li>
                            
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                            <span class="nk-menu-text">Products</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('products.index')}}" class="nk-menu-link"><span class="nk-menu-text">Product List</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('products.create')}}" class="nk-menu-link"><span class="nk-menu-text"> Add Product </span></a>
                            </li>
                            
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-grid-alt-fill"></em></span>
                            <span class="nk-menu-text">Video Category</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('admin.videoCategory')}}" class="nk-menu-link"><span class="nk-menu-text"> Video Category list</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.videoCategory.create')}}" class="nk-menu-link"><span class="nk-menu-text">Add Video Category</span></a>
                            </li>
                            
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                            <span class="nk-menu-text">Video</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('admin.video')}}" class="nk-menu-link"><span class="nk-menu-text">Video List</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.video.create')}}" class="nk-menu-link"><span class="nk-menu-text">Add Video</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Settings</h6>
                    </li><!-- .nk-menu-heading -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-add"></em></span>
                            <span class="nk-menu-text">Affilation</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('admin/affiliation')}}" class="nk-menu-link"><span class="nk-menu-text">Affilation Setting </span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-setting-alt-fill"></em></span>
                            <span class="nk-menu-text">Setting</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('admin/payment_methods')}}" class="nk-menu-link"><span class="nk-menu-text">Payment Methods</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{url('admin/admin_accounts')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-check-fill"></em></span>
                            <span class="nk-menu-text">Account Numbers</span>
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