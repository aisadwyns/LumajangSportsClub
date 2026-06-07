{{-- <div>
    <li class="pc-item">
        <a href="{{ route($route) }}" class="pc-link {{ $active }}">
            <span class="pc-micon"><i class="{{ $icon }}"></i></span>
            <span class="pc-mtext">{{ $title }}</span>
        </a>
    </li>
</div> --}}
{{-- @props(['title', 'icon', 'route']) --}}

{{-- @php
    // Mengecek apakah rute saat ini cocok dengan parameter route yang dikirim
    // Menggunakan asterisk (*) agar sub-route (seperti edit/create) tetap membuat menu ini aktif
    $isActive = request()->routeIs($route . '*') ? 'active' : '';
@endphp

<li class="pc-item {{ $isActive }}">
    <a href="{{ route($route) }}" class="pc-link">
        <span class="pc-micon"><i class="{{ $icon }}"></i></span>
        <span class="pc-mtext">{{ $title }}</span>
    </a>
</li> --}}

@props(['route', 'icon', 'title'])

@php
    // 1. Ambil nama rute yang sedang aktif saat ini (misal: 'admin.venues.edit' atau 'challenge.show')
    $currentRouteName = request()->route() ? request()->route()->getName() : '';

    // 2. Ambil kata kunci utama dari rute menu komponen ini (misal: 'challenge.index' diambil 'challenge')
    // Kita bersihkan juga kata '.index' jika ada agar pencocokan lebih bersih
    $menuBaseName = str_replace('.index', '', $route);

    // 3. Logika pengecekan "Pintar":
    // Menu akan AKTIFF jika nama rute saat ini mengandung kata dasar dari menu tersebut,
    // ATAU nama rute saat ini sama persis dengan rute menu.
    $isActive = str_contains($currentRouteName, $menuBaseName) || $currentRouteName === $route ? 'active' : '';
@endphp

<li class="pc-item {{ $isActive }}">
    <a href="{{ route($route) }}" class="pc-link">
        <span class="pc-micon"><i class="{{ $icon }}"></i></span>
        <span class="pc-mtext">{{ $title }}</span>
    </a>
</li>
