<nav class="navbar is-info has-shadow" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item">
                <span class="icon">
                    <i class="fa fa-icon"></i>
                </span>
                <span>
                    Eye CBR
                </span>
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="">
                    <span class="icon">
                        <i class="fa fa-home"></i>
                    </span>
                    <span>
                        Home
                    </span>
                </a>

                <a class="navbar-item">
                    <span class="icon">
                        <i class="fa fa-book"></i>
                    </span>
                    <span>
                        Docs
                    </span>
                </a>
            </div>
            
            <div class="navbar-end">
                <div class="navbar-item">
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
                </div>
            </div>
        </div>
    </div>
</nav>