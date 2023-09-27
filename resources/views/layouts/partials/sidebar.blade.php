<nav class="mt-2">
    <h2 class="text-primary text-capitalize">{{ Auth::user()->name }}</h2>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item ">
            <a href="{{ route('home') }}" class="nav-link {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Home</p>
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{ route('dashboard.categories.index') }}"
                class="nav-link  {{ Route::currentRouteName() == 'dashboard.categories.index' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>categories</p>
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{ route('dashboard.products.index') }}"
                class="nav-link  {{ Route::currentRouteName() == 'dashboard.products.index' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>products</p>
            </a>
        </li>
    </ul>
</nav>
