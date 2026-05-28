{{-- <div>
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Home</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Home</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div>
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        {{-- Mengambil segmen terakhir URL sebagai Judul Halaman Utama (Kapital Awal) --}}
                        <h5 class="m-b-10">{{ ucfirst(request()->segment(count(request()->segments()))) }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        {{-- Menu Home awal yang statis --}}
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>

                        @php $link = ''; @endphp
                        @foreach (request()->segments() as $index => $segment)
                            @php
                                // Abaikan segmen jika namanya 'home' agar tidak duplikat dengan menu awal
                                if ($segment == 'home') {
                                    continue;
                                }

                                $link .= '/' . $segment;
                            @endphp

                            {{-- Jika ini adalah segmen terakhir, set sebagai menu aktif (tidak bisa diklik) --}}
                            @if ($index + 1 == count(request()->segments()))
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ ucfirst(str_replace('-', ' ', $segment)) }}
                                </li>
                            @else
                                {{-- Jika masih ada segmen lanjutan, buat sebagai link --}}
                                <li class="breadcrumb-item">
                                    <a href="{{ url($link) }}">{{ ucfirst(str_replace('-', ' ', $segment)) }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
