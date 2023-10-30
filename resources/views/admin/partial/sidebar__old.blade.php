<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{AdminHelper::adminPath('admin')}}" class="logo logo-dark">
            @if(!empty(AdminHelper::getSetting('logo')))
            <span class="logo-sm">
                <img src="{{ AdminHelper::getSetting('logo') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ AdminHelper::getSetting('logo') }}" alt="" height="17">
            </span>
            @else
            <span class="logo-sm">{{AdminHelper::getSetting('appname')}}</span>
            <span class="logo-lg">
                {{AdminHelper::getSetting('appname')}}
            </span>
            @endif
        </a>
        <!-- Light Logo-->
        <a href="{{AdminHelper::adminPath('admin')}}" class="logo logo-light">
            @if(!empty(AdminHelper::getSetting('logo')))
            <span class="logo-sm">
                <img src="{{ AdminHelper::getSetting('logo') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ AdminHelper::getSetting('logo') }}" alt="" height="17">
            </span>
            @else
            <span class="logo-sm">{{AdminHelper::getSetting('appname')}}</span>
            <span class="logo-lg">
                {{AdminHelper::getSetting('appname')}}
            </span>
            @endif
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('/')) ? 'active' : '' }}" href="{{AdminHelper::adminPath('admin')}}">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('customers*')) ? 'active' : '' }}" href="#sidebarAdminCustomer" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('customers*')) ? 'true' : 'false' }}" aria-controls="sidebarAdminCustomer">
                        <i class="ri-user-add-line"></i> <span>Manage Customers</span>
                    </a>
                    <div class="collapse {{ (Request::is('customers*')) ? 'show' : '' }} menu-dropdown" id="sidebarAdminCustomer">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href='{{ route("addCustomer") }}' class="nav-link {{ (Request::is('customers/add*')) ? 'active' : '' }}"> Add Customer </a>
                            </li>
                            <li class="nav-item">
                                <a href='{{ route("getIndexCustomer") }}' class="nav-link {{ (Request::is('customers')) ? 'active' : '' }}"> List Customers</a>
                            </li>                          
                        </ul>
                    </div>
                </li>

                 <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('vendor*')) ? 'active' : '' }}" href="#sidebarAdminVendor" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('vendor*')) ? 'true' : 'false' }}" aria-controls="sidebarAdminVendor">
                        <i class="ri-map-pin-user-fill"></i> <span>Manage Vendor</span>
                    </a>
                    <div class="collapse {{ (Request::is('vendor*')) ? 'show' : '' }} menu-dropdown" id="sidebarAdminVendor">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href='{{ route("addVendor") }}' class="nav-link {{ (Request::is('vendor/add*')) ? 'active' : '' }}"> Add Vendor </a>
                            </li>
                            <li class="nav-item">
                                <a href='{{ route("getIndexVendor") }}' class="nav-link {{ (Request::is('vendor')) ? 'active' : '' }}"> List Vendor</a>
                            </li>                          
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('servicedirectory*')) ? 'active' : '' }}" href="#sidebarAdminservicedirectory" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('servicedirectory*')) ? 'true' : 'false' }}" aria-controls="sidebarAdminservicedirectory">
                      <i class="ri-service-line"></i><span>Vendor Services</span>
                    </a>
                    <div class="collapse {{ (Request::is('servicedirectory*')) ? 'show' : '' }} menu-dropdown" id="sidebarAdminservicedirectory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href='{{ route("getIndexvendorServiceDirectory") }}?t=new' class="nav-link {{ (Request::is('servicedirectory')) ? 'active' : '' }}">New Vendor Services</a>
                            </li> 
                            <li class="nav-item">
                                <a href='{{ route("getIndexvendorServiceDirectory") }}?t=edited' class="nav-link {{ (Request::is('servicedirectory')) ? 'active' : '' }}">Edited Vendor Services</a>
                            </li>
                             <li class="nav-item">
                                <a href='{{ route("getIndexvendorServiceDirectory") }}?t=approved' class="nav-link {{ (Request::is('servicedirectory')) ? 'active' : '' }}">Approved Vendor Services</a>
                            </li> 
                             <li class="nav-item">
                                <a href='{{ route("getIndexvendorServiceDirectory") }}?t=rejected' class="nav-link {{ (Request::is('servicedirectory')) ? 'active' : '' }}">Rejected Vendor Services</a>
                            </li>
                             <li class="nav-item">
                                <a href='{{ route("vendorServiceDirectory") }}' class="nav-link {{ (Request::is('servicedirectory')) ? 'active' : '' }}"> Add Vendor Services</a>
                            </li>                          
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('servicecategory*')) ? 'active' : '' }}" href="#sidebarAdminservicecategory" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('servicecategory*')) ? 'true' : 'false' }}" aria-controls="sidebarAdminservicecategory">
                        <i class="ri-file-paper-line"></i> <span>Service Category</span>
                    </a>
                    <div class="collapse {{ (Request::is('servicecategory*')) ? 'show' : '' }} menu-dropdown" id="sidebarAdminservicecategory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href='{{ route("addserviceCategory") }}' class="nav-link {{ (Request::is('servicecategory/add*')) ? 'active' : '' }}"> Add Service Category </a>
                            </li>
                            <li class="nav-item">
                                <a href='{{ route("getIndexserviceCategory") }}' class="nav-link {{ (Request::is('servicecategory')) ? 'active' : '' }}"> List Service Category</a>
                            </li>                          
                        </ul>
                    </div>
                </li>

                  <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('vendorcategory*')) ? 'active' : '' }}" href="#sidebarAdminvendorcategory" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('vendorcategory*')) ? 'true' : 'false' }}" aria-controls="sidebarAdminvendorcategory">
                       <i class="ri-list-check"></i> <span>Vendor Category</span>
                    </a>
                    <div class="collapse {{ (Request::is('vendorcategory*')) ? 'show' : '' }} menu-dropdown" id="sidebarAdminvendorcategory">
                        <ul class="nav nav-sm flex-column">
                            <!-- <li class="nav-item">
                                <a href='{{ route("addvendorCategory") }}' class="nav-link {{ (Request::is('vendorcategory/add*')) ? 'active' : '' }}"> Add Vendor Category </a>
                            </li> -->
                            <li class="nav-item">
                                <a href='{{ route("getIndexvendorCategory") }}' class="nav-link {{ (Request::is('vendorcategory')) ? 'active' : '' }}"> List Vendor Category</a>
                            </li>                          
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('managesubscription*')) ? 'active' : '' }}" href="#sidebarAdminmanagesubscription" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('managesubscription*')) ? 'true' : 'false' }}" aria-controls="sidebarAdminmanagesubscription">
                       <i class="ri-coupon-line"></i><span>Subscription</span>
                    </a>
                    <div class="collapse {{ (Request::is('managesubscription*')) ? 'show' : '' }} menu-dropdown" id="sidebarAdminmanagesubscription">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href='{{ route("addManageSubscription") }}' class="nav-link {{ (Request::is('managesubscription/add*')) ? 'active' : '' }}"> Add Subscription </a>
                            </li>
                            <li class="nav-item">
                                <a href='{{ route("getIndexManageSubscription") }}' class="nav-link {{ (Request::is('managesubscription')) ? 'active' : '' }}"> List Subscription</a>
                            </li>                          
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('manage-cms')) ? 'active' : '' }}" href="{{route('getManageCMS')}}">
                        <i class="fa fa-th-list"></i> <span>Manage CMS</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('settings*')) ? 'active' : '' }}" href="#sidebarAdminSettings" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('settings*')) ? 'true' : 'false' }}" aria-controls="sidebarAdminSettings">
                        <i class="ri-settings-2-line"></i> <span>Settings</span>
                    </a>
                    <div class="collapse {{ (Request::is('settings*')) ? 'show' : '' }} menu-dropdown" id="sidebarAdminSettings">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href='{{ route("getGeneralSettings") }}' class="nav-link {{ (Request::is('settings/general-settings')) ? 'active' : '' }}"> General Settings </a>
                            </li>
                            <li class="nav-item">
                                <a href='{{ route("getEmailSettings") }}' class="nav-link {{ (Request::is('settings/email-settings')) ? 'active' : '' }}"> Email Settings</a>
                            </li>                          
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>