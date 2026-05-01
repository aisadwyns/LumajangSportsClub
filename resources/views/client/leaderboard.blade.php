@extends('layouts.client')

@section('content')
    <style>
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

        /* Top 3 Styling */
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

        /* Elements Width & Styling */
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
            /* Warna hijau sesuai gambar */
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
            /* Warna teks tier */
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
            /* Warna teks XP (pink/merah) */
            font-size: 1rem;
        }
    </style>

    <div class="container-fluid py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: #004AAC;">LEADERBOARD</h2>
            <p class="text-muted">Peringkat Aktivitas Teratas di Lumajang Sports Club</p>
        </div>

        <div class="leaderboard-wrapper">

            {{-- Peringkat 1 --}}
            <div class="lb-row lb-rank-1">
                <div class="lb-num">1</div>
                <div class="lb-trophy"><i class="bi bi-trophy-fill text-warning"></i></div>
                <div class="lb-avatar">
                    <img src="https://i.pravatar.cc/150?u=roger" alt="Avatar">
                </div>
                <div class="lb-user-info">
                    <div class="lb-name">Roger Korsgaard</div>
                    <div class="lb-role">Professional Athlete</div>
                </div>
                <div class="lb-tier">
                    <img src="https://ui-avatars.com/api/?name=P+V&background=d97706&color=fff&rounded=true" alt="Badge">
                    PRO V
                </div>
                <div class="lb-xp">
                    <i class="bi bi-fire"></i> 615 Pts
                </div>
            </div>

            {{-- Peringkat 2 --}}
            <div class="lb-row lb-rank-2">
                <div class="lb-num">2</div>
                <div class="lb-trophy"><i class="bi bi-trophy-fill" style="color: #adb5bd;"></i></div>
                <div class="lb-avatar">
                    <img src="https://i.pravatar.cc/150?u=charlie" alt="Avatar">
                </div>
                <div class="lb-user-info">
                    <div class="lb-name">Charlie Herwitz</div>
                    <div class="lb-role">Swing Trader / Tennis</div>
                </div>
                <div class="lb-tier">
                    <img src="https://ui-avatars.com/api/?name=P+V&background=d97706&color=fff&rounded=true" alt="Badge">
                    PRO V
                </div>
                <div class="lb-xp">
                    <i class="bi bi-fire" style="color: #ff6b6b;"></i> 587 Pts
                </div>
            </div>

            {{-- Peringkat 3 --}}
            <div class="lb-row lb-rank-3">
                <div class="lb-num">3</div>
                <div class="lb-trophy"><i class="bi bi-trophy-fill" style="color: #fd7e14;"></i></div>
                <div class="lb-avatar">
                    <img src="https://i.pravatar.cc/150?u=ahmad" alt="Avatar">
                </div>
                <div class="lb-user-info">
                    <div class="lb-name">Ahmad Mango</div>
                    <div class="lb-role">Hard Hitter / Futsal</div>
                </div>
                <div class="lb-tier">
                    <img src="https://ui-avatars.com/api/?name=P+IV&background=d97706&color=fff&rounded=true"
                        alt="Badge">
                    PRO IV
                </div>
                <div class="lb-xp">
                    <i class="bi bi-fire" style="color: #ff6b6b;"></i> 353 Pts
                </div>
            </div>

            {{-- Peringkat 4 --}}
            <div class="lb-row">
                <div class="lb-num">4</div>
                <div class="lb-trophy"></div> {{-- Dikosongkan agar sejajar --}}
                <div class="lb-avatar">
                    <img src="https://i.pravatar.cc/150?u=siti" alt="Avatar">
                </div>
                <div class="lb-user-info">
                    <div class="lb-name">Siti Romzatul Alimah</div>
                    <div class="lb-role">Badminton Enthusiast</div>
                </div>
                <div class="lb-tier">
                    <img src="https://ui-avatars.com/api/?name=R+IV&background=e2e8f0&color=475569&rounded=true"
                        alt="Badge">
                    ROOKIE IV
                </div>
                <div class="lb-xp">
                    <i class="bi bi-fire" style="color: #ff6b6b;"></i> 191 Pts
                </div>
            </div>

            {{-- Peringkat 5 --}}
            <div class="lb-row">
                <div class="lb-num">5</div>
                <div class="lb-trophy"></div>
                <div class="lb-avatar">
                    <img src="https://i.pravatar.cc/150?u=tio" alt="Avatar">
                </div>
                <div class="lb-user-info">
                    <div class="lb-name">Muhammad Tio Helambang</div>
                    <div class="lb-role">Basketball Player</div>
                </div>
                <div class="lb-tier">
                    <img src="https://ui-avatars.com/api/?name=R+II&background=e2e8f0&color=475569&rounded=true"
                        alt="Badge">
                    ROOKIE II
                </div>
                <div class="lb-xp">
                    <i class="bi bi-fire" style="color: #ff6b6b;"></i> 129 Pts
                </div>
            </div>

        </div>
    </div>
@endsection
