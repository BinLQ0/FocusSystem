<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Application Logo -->
    <a href="#" class="brand-link">
        <img src="#" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">FOCSystem</span>
    </a>
    <!-- ./Application Logo -->

    <div class="sidebar">
        
        <!-- .User Profile -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src='https://ui-avatars.com/api/?name={{ Auth::user()->username }}&background=0D8ABC&color=fff' class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->username }}</a>
            </div>
        </div>
        <!-- ./User Profile -->

        <!-- Sidebar Menu -->
        <nav class="mt-2 pb-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <x-sidebar-menu label='Home' :url="route('home')" icon='fas fa-home' />

                <li class="nav-header"></li>
                <x-sidebar-menu label='Product' :url="route('product.index')" icon='fas fa-boxes' />

                @can('manufacture module')
                <li class="nav-header">MANUFACTURE</li>
                <x-sidebar-menu label='Release Material' :url="route('release-material.index')" icon='fas fa-box-open' />
                <x-sidebar-menu label='Product Result' :url="route('product-result.index')" icon='fas fa-box' />
                <x-sidebar-menu label='Job Cost' :url="route('job-cost.index')" icon='fas fa-drafting-compass' />
                @endcan

                @can('warehouse module')
                <li class="nav-header">DISTRIBUTION CENTER</li>
                <x-sidebar-menu label='Receive item' :url="route('receive-item.index')" icon='fas fa-truck-loading' />
                <x-sidebar-menu label='Delivery Order' :url="route('delivery-order.index')" icon='fas fa-truck-moving' />
                @endcan

                @can('warehouse module')
                <li class="nav-header">WAREHOUSE</li>
                <x-sidebar-menu label='Adjustment' :url="route('adjustment.index')" icon='fas fa-pencil-ruler' />
                @endcan

                @can('admin module')
                <li class="nav-header">ADMINISTRATOR</li>
                <x-sidebar-menu label='Users Management' :url="route('user.index')" icon='fas fa-users'/>
                <x-sidebar-menu label='Roles Management' :url="route('role.index')" icon='fas fa-user-tag' />
                @endcan

                @can('warehouse module')
                <li class="nav-header">DATA MASTER</li>
                <x-sidebar-menu label='Relation Company' :url="route('company.index')" icon='far fa-building' />
                <x-sidebar-menu label='Product Type' :url="route('product-type.index')" icon='fas fa-tags' />
                <x-sidebar-menu label='Warehouse' :url="route('warehouse.index')" icon='fas fa-warehouse' />
                <x-sidebar-menu label='Vehicle' :url="route('vehicle.index')" icon='fas fa-truck' />
                @endcan

                <li class="nav-header">PROFILE</li>
                <x-sidebar-menu label='Logout' :url="route('logout')" icon='fas fa-sign-out-alt' />
            </ul>
        </nav>
        <!-- ./Sidebar Menu -->

    </div>
</aside>