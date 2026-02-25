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
                {{-- LOGIKA AUTHENTICATION --}}
                @auth
                    {{-- Tampilan saat User SUDAH Login --}}
                    <li class="dropdown">
                        <a href="#" class="profile-nav d-flex align-items-center">
                            <img src="{{ auth()->user()->profile?->avatar ? asset('storage/avatar_user/' . auth()->user()->profile->avatar) : asset('assets/img/default-avatar.png') }}"
                                alt="Profile" class="rounded-circle me-1"
                                style="width: 30px; height: 30px; object-fit: cover;">
                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <li class="px-3 py-2 border-bottom">
                                <span class="d-block fw-bold small text-dark">{{ auth()->user()->name }}</span>
                                <span class="text-muted small" style="font-size: 11px;">{{ auth()->user()->email }}</span>
                            </li>
                            <li><a href="{{ route('profil.edit', 'me') }}">Profil Saya</a></li>
                            <li><a href="{{ route('komunitas.index') }}">Riwayat</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item text-danger border-0 bg-transparent ps-3">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Tampilan saat User BELUM Login (Guest) --}}
                    <li>
                        <a href="{{ route('login') }}" class="btn btn-primary text-white px-4 ms-2"
                            style="border-radius: 20px;">Sign In</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary px-4 ms-2"
                            style="border-radius: 20px;">Sign Up</a>
                    </li>
                @endauth

            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>



    </div>

</div>
