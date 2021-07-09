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

                @can('admin module')
                <x-sidebar-menu label='Users Management' :url="route('user.index')" icon='fas fa-users' />
                @endcan

                <li class="nav-header">DATA MASTER</li>
                @can('warehouse module')
                <x-sidebar-menu label='Product Type' :url="route('product-type.index')" icon='fas fa-tags' />
                <x-sidebar-menu label='Warehouse' :url="route('warehouse.index')" icon='fas fa-warehouse' />
                @endcan

                <li class="nav-header">PROFILE</li>
                <x-sidebar-menu label='Logout' :url="route('logout')" icon='fas fa-sign-out-alt' />
            </ul>
        </nav>
        <!-- ./Sidebar Menu -->

    </div>
</aside>