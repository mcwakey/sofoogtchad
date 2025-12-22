<aside class="admin-sidebar">
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages*') ? 'active' : '' }}">
                    Pages
                </a>
            </li>

            <li>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                    Categories
                </a>
            </li>

            <li>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                    Products
                </a>
            </li>

            <li>
                <a href="{{ route('admin.process-steps.index') }}" class="{{ request()->routeIs('admin.process-steps*') ? 'active' : '' }}">
                    Process Steps
                </a>
            </li>

            <li>
                <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts*') ? 'active' : '' }}">
                    Posts
                </a>
            </li>

            <li>
                <a href="{{ route('admin.partners.index') }}" class="{{ request()->routeIs('admin.partners*') ? 'active' : '' }}">
                    Partners
                </a>
            </li>

            <li>
                <a href="{{ route('admin.distributor-requests.index') }}" class="{{ request()->routeIs('admin.distributor-requests*') ? 'active' : '' }}">
                    Distributor Requests
                </a>
            </li>

            <li>
                <a href="{{ route('admin.media.index') }}" class="{{ request()->routeIs('admin.media*') ? 'active' : '' }}">
                    Media Library
                </a>
            </li>

            @if(auth()->user()->hasRole('admin'))
                <li>
                    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.roles.index') }}" class="{{ request()->routeIs('admin.roles*') ? 'active' : '' }}">
                        Roles
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                        Settings
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</aside>
