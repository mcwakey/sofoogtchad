<header class="admin-header">
    <div class="header-brand">
        <a href="{{ route('admin.dashboard') }}">
            {{ config('app.name', 'Sofoodtchad') }} Admin
        </a>
    </div>

    <nav class="header-nav">
        @auth
            <span class="user-name">{{ auth()->user()->name }}</span>
            <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
    </nav>
</header>
