<aside class="admin-sidebar">
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
                    Dashboard
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
            @endif
        </ul>
    </nav>
</aside>
