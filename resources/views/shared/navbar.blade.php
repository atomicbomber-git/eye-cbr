<nav class="navbar is-info has-shadow" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item">
                <span class="icon">
                    <i class="fa fa-icon"></i>
                </span>
                <span>
                    {{ config('app.name') }}
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
                    <a class="navbar-item" href="{{ route('home') }}">
                        <span class="icon">
                            <i class="fa fa-home"></i>
                        </span>
                        <span>
                            Home
                        </span>
                    </a>

                    <a class="navbar-item" href="{{ route('konsultasi.create') }}">
                        <span class="icon">
                            <i class="fa fa-check-circle-o"></i>
                        </span>
                            <span>
                            Konsultasi
                        </span>
                    </a>

                    <a class="navbar-item" href="{{ route('bantuan') }}">
                        <span class="icon">
                            <i class="fa fa-question-circle"></i>
                        </span>
                        <span>
                            Bantuan
                        </span>
                    </a>

                    <a class="navbar-item" href="{{ route('tentang-saya') }}">
                        <span class="icon">
                            <i class="fa fa-info-circle"></i>
                        </span>
                        <span>
                            Tentang Saya
                        </span>
                    </a>
            </div>

            <div class="navbar-end">
                @auth

                <a class="navbar-item" href="{{ route('admin-home') }}">
                    <span class="icon">
                        <i class="fa fa-user"></i>
                    </span>
                    <span>
                        Website Administrator
                    </span>
                </a>

                @endauth

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