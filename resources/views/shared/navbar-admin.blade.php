<nav class="navbar is-danger has-shadow" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item">
                <span class="icon">
                    <i class="fa fa-icon"></i>
                </span>
                <span>
                    {{ config('app.name') }} (ADMIN)
                </span>
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbar">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        
        <div id="navbar" class="navbar-menu">
            <div class="navbar-start">
                @auth
                    <a class="navbar-item" href="{{ route('verified_case.index') }}">
                    <span class="icon">
                        <i class="fa fa-archive"></i>
                    </span>
                        <span>
                        Basis Kasus
                    </span>
                    </a>

                    <a class="navbar-item" href="{{ route('unverified_case.index') }}">
                    <span class="icon">
                        <i class="fa fa-circle"></i>
                    </span>
                        <span>
                        Kasus Baru
                    </span>
                    </a>

                    <a class="navbar-item" href="{{ route('feature.index') }}">
                    <span class="icon">
                        <i class="fa fa-list-alt"></i>
                    </span>
                        <span>
                        Gejala
                    </span>
                    </a>
                @endauth
            </div>

            <div class="navbar-end">
                <a class="navbar-item" href="{{ route('home') }}">
                    <span class="icon">
                        <i class="fa fa-user"></i>
                    </span>
                    <span>
                        Website Umum
                    </span>
                </a>

                <div class="navbar-item">
                    @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="button is-danger">
                            <span>
                                Keluar
                            </span>
                            <span class="icon is-small">
                                <i class="fa fa-sign-out"></i>
                            </span>
                        </button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>