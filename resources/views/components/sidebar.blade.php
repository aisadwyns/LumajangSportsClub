<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="/" class="b-brand text-primary">
                <!-- ========   Change your logo from here
                    <img src="{{ asset('template/dist') }}/assets/images/logo-dark.svg" class="img-fluid logo-lg"
                        alt="logo"> ============ -->
                <p>Lumajang Sports Club</p>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                @if (Auth::user()->role->role_name == 'user')
                    <x-sidebar.links title='Dashboard' icon='ti ti-dashboard' route='home' />
                    <li class="pc-item pc-caption"><label>Booking Data</label><i class="ti ti-dashboard"></i></li>
                    <x-sidebar.links title='Profile' icon='ti ti-user' route='profil.index' />
                    <x-sidebar.links title='Riwayat Booking' icon='ti ti-user' route='home' />
                    <x-sidebar.links title='Riwayat Komunitas' icon='ti ti-user' route='riwayat.komunitas' />
                @endif

                @if (Auth::user()->role->role_name == 'venue')
                    <x-sidebar.links title='Dashboard' icon='ti ti-dashboard' route='home' />
                    <li class="pc-item pc-caption"><label>Booking Data</label><i class="ti ti-dashboard"></i></li>
                    <x-sidebar.links title='Profile' icon='ti ti-user' route='profil.index' />
                    <x-sidebar.links title='Riwayat Booking' icon='ti ti-user' route='home' />
                    <x-sidebar.links title='Riwayat Komunitas' icon='ti ti-user' route='riwayat.komunitas' />
                    <li class="pc-item pc-caption"><label>Other</label><i class="ti ti-news"></i></li>
                    <x-sidebar.links title='Jadwal' icon='ti ti-calendar' route='riwayat.komunitas' />
                    <x-sidebar.links title='Member' icon='ti ti-clipboard-list' route='riwayat.komunitas' />
                    <x-sidebar.links title='Lapangan' icon='ti ti-layout-grid' route='riwayat.komunitas' />
                @endif

                @if (Auth::user()->role->role_name == 'superadmin')
                    <x-sidebar.links title='Dashboard' icon='ti ti-dashboard' route='home' />
                    <li class="pc-item pc-caption"><label>Booking Data</label><i class="ti ti-dashboard"></i></li>
                    <x-sidebar.links title='Data Team' icon='ti ti-user' route='lscteam.index' />
                    <x-sidebar.links title='Data Pengguna' icon='ti ti-users' route='users.index' />
                    <x-sidebar.links title='Data Venue' icon='ti ti-users' route='admin.venues' />


                    <x-sidebar.links title='Data Member' icon='ti ti-user' route='member.index' />
                    <x-sidebar.links title='Bagian' icon='ti ti-clipboard-list' route='bagian.index' />
                    <x-sidebar.links title='Lapangan' icon='ti ti-layout-grid' route='lapangan.index' />
                    <x-sidebar.links title='Komunitas' icon='ti ti-layout-grid' route='komunitas.index' />
                    <li class="pc-item pc-caption"><label>Other</label><i class="ti ti-news"></i></li>
                    <x-sidebar.links title='Events' icon='ti ti-calendar' route='event.index' />
                    <x-sidebar.links title='Challenge' icon='ti ti-clipboard-list' route='blog.index' />

                    <x-sidebar.links title='Jenis Komunitas' icon='ti ti-layout-grid' route='jenis-komunitas.index' />

                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span
                                class="pc-mtext">Pemeliharaan</span><span class="pc-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            {{-- <li class="pc-item"><a class="pc-link" href="#!">Blog</a></li> --}}
                            <x-sidebar.links title='Konten' icon='ti ti-news' route='blog.index' />
                            <li class="pc-item"><a class="pc-link" href="#!">Galeri</a></li>
                            <li class="pc-item pc-hasmenu">
                                <a href="#!" class="pc-link">Level 2.2<span class="pc-arrow"><i
                                            data-feather="chevron-right"></i></span></a>
                                <ul class="pc-submenu">
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                    <li class="pc-item pc-hasmenu">
                                        <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i
                                                    data-feather="chevron-right"></i></span></a>
                                        <ul class="pc-submenu">
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="pc-item pc-hasmenu">
                                <a href="#!" class="pc-link">Level 2.3<span class="pc-arrow"><i
                                            data-feather="chevron-right"></i></span></a>
                                <ul class="pc-submenu">
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                    <li class="pc-item pc-hasmenu">
                                        <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i
                                                    data-feather="chevron-right"></i></span></a>
                                        <ul class="pc-submenu">
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
