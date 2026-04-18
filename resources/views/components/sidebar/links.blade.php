{{-- <div>
    <li class="pc-item">
        <a href="{{ route($route) }}" class="pc-link {{ $active }}">
            <span class="pc-micon"><i class="{{ $icon }}"></i></span>
            <span class="pc-mtext">{{ $title }}</span>
        </a>
    </li>
</div> --}}
{{-- @props(['title', 'icon', 'route']) --}}

@php
    // Mengecek apakah rute saat ini cocok dengan parameter route yang dikirim
    // Menggunakan asterisk (*) agar sub-route (seperti edit/create) tetap membuat menu ini aktif
    $isActive = request()->routeIs($route . '*') ? 'active' : '';
@endphp

<li class="pc-item {{ $isActive }}">
    <a href="{{ route($route) }}" class="pc-link">
        <span class="pc-micon"><i class="{{ $icon }}"></i></span>
        <span class="pc-mtext">{{ $title }}</span>
    </a>
</li>
