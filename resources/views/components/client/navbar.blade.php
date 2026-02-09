<div class="branding d-flex align-items-cente">

    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.webp" alt=""> -->
            <h1 class="sitename">Lumajang Sports Club</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('client') }}" class="active">Home</a></li>
                <li><a href="about.html">Sewa Lapangan</a></li>
                <li><a href="{{ route('komunitas.public') }}"
                        class="{{ request()->routeIs('komunitas.public') ? 'active' : '' }}">Gabung Komunitas</a></li>
                <li><a href="{{ route('events.public') }}"
                        class="{{ request()->routeIs('events.public') ? 'active' : '' }}">Event</a></li>

                <li><a href="{{ route('blogs.public') }}"
                        class="{{ request()->routeIs('blogs.public') ? 'active' : '' }}">Blog</a></li>
                <li><a href="doctors.html">LSC Holiday</a></li>
                <li class="dropdown"><a href="#"><span>Lainnya</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Leaderboard</a></li>
                        <li class="dropdown"><a href="#"><span>Produk</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Jersey</a></li>
                                <li><a href="#">Merchandise</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Challange</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('login') }}" class="btn btn-primary">Sign In</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>



    </div>

</div>
