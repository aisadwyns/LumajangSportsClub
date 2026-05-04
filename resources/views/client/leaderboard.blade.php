@extends('layouts.client')

@section('content')
    <style>
        /* ... (Masukkan semua kode CSS Kakak sebelumnya di sini) ... */
        .leaderboard-wrapper {
            max-width: 1000px;
            margin: 0 auto;
        }

        .lb-row {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            margin-bottom: 12px;
            border-radius: 12px;
            background-color: #ffffff;
            border: 1px solid #f0f0f0;
            transition: transform 0.2s ease;
        }

        .lb-row:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .lb-rank-1 {
            background: linear-gradient(to right, #fff8e1 0%, #ffffff 50%);
            border-left: 6px solid #ffc107;
            border-top: none;
            border-right: none;
            border-bottom: none;
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.15);
        }

        .lb-rank-2 {
            background: linear-gradient(to right, #f1f3f5 0%, #ffffff 50%);
            border-left: 6px solid #ced4da;
            border-top: none;
            border-right: none;
            border-bottom: none;
            box-shadow: 0 4px 10px rgba(173, 181, 189, 0.15);
        }

        .lb-rank-3 {
            background: linear-gradient(to right, #fff3e0 0%, #ffffff 50%);
            border-left: 6px solid #fd7e14;
            border-top: none;
            border-right: none;
            border-bottom: none;
            box-shadow: 0 4px 10px rgba(253, 126, 20, 0.15);
        }

        .lb-num {
            width: 40px;
            font-weight: 800;
            font-size: 1.1rem;
            color: #333;
            text-align: center;
        }

        .lb-trophy {
            width: 60px;
            text-align: center;
            font-size: 1.8rem;
        }

        .lb-avatar img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #20c997;
            padding: 2px;
        }

        .lb-user-info {
            flex-grow: 1;
            padding-left: 20px;
        }

        .lb-name {
            font-weight: 700;
            font-size: 1.05rem;
            color: #212529;
            margin-bottom: 2px;
            text-transform: capitalize;
        }

        .lb-role {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 0;
        }

        .lb-tier {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 150px;
            font-weight: 700;
            color: #20c997;
            font-size: 0.95rem;
        }

        .lb-tier img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .lb-xp {
            width: 100px;
            text-align: right;
            font-weight: 700;
            color: #e83e8c;
            font-size: 1rem;
        }
    </style>

    <div class="container-fluid py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #004AAC;">LEADERBOARD</h2>
            <p class="text-muted">Peringkat Aktivitas Teratas di Lumajang Sports Club</p>
        </div>

        <div class="leaderboard-wrapper">

            @foreach ($leaderboard as $index => $user)
                {{-- Logika class dipindah langsung ke dalam atribut class --}}
                <div
                    class="lb-row {{ $index == 0 ? 'lb-rank-1' : ($index == 1 ? 'lb-rank-2' : ($index == 2 ? 'lb-rank-3' : '')) }}">

                    <div class="lb-num">{{ $index + 1 }}</div>

                    {{-- Logika trophy menggunakan Blade if-else langsung di HTML-nya --}}
                    @if ($index == 0)
                        <div class="lb-trophy"><i class="bi bi-trophy-fill text-warning"></i></div>
                    @elseif ($index == 1)
                        <div class="lb-trophy"><i class="bi bi-trophy-fill" style="color: #adb5bd;"></i></div>
                    @elseif ($index == 2)
                        <div class="lb-trophy"><i class="bi bi-trophy-fill" style="color: #fd7e14;"></i></div>
                    @else
                        <div class="lb-trophy"></div>
                    @endif

                    <div class="lb-avatar">
                        {{-- Logika avatar dijadikan satu baris (ternary) langsung di dalam src --}}
                        <img src="{{ !empty($user->avatar) ? asset('storage/avatar_user' . $user->profile?->avatar) : asset('client/dist/assets/img/customavatar-' . (($user->id % 5) + 1) . '.png') }}"
                            alt="Avatar {{ $user->name }}">
                    </div>

                    <div class="lb-user-info">
                        <div class="lb-name">{{ $user->name }}</div>
                        <div class="lb-role">Sports Enthusiast</div>
                    </div>

                    <div class="lb-tier">
                        {{-- Logika inisial nama langsung di-echo di dalam link URL --}}
                        <img src="https://ui-avatars.com/api/?name={{ strtoupper(substr($user->name, 0, 1)) }}&background=d97706&color=fff&rounded=true"
                            alt="Badge">
                        PRO V
                    </div>

                    <div class="lb-xp">
                        <i class="bi bi-fire" style="color: #ff6b6b;"></i> {{ number_format($user->points, 0, ',', '.') }}
                        Pts
                    </div>

                </div>
            @endforeach

        </div>
    </div>
@endsection
