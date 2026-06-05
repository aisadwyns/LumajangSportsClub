@extends('layouts.mantis')

@section('content')
    <div class="container-fluid px-4 mt-4">
        <div class="card border-0 shadow-sm mb-4"
            style="border-radius: 12px; background: linear-gradient(135deg,  #1c4ed8, #004aac);">
            <div class="card-body p-4 text-white d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-white-50 text-uppercase fw-semibold mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">
                        Total Poin</h6>
                    <h2 class="mb-0 fw-bold text-white">{{ number_format($user->points) }} <span
                            style="font-size: 1.2rem; font-weight: 500;">Pts</span></h2>
                </div>
                <div class="avtar avtar-lg rounded-circle bg-white-20 text-white">
                    <i class="ti ti-trophy" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <h5 class="mb-3 fw-bold text-dark">Riwayat Poin Saya</h5>
                <div class="card tbl-card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0 align-middle">
                                <thead>
                                    <tr class="text-secondary" style="font-size: 0.85rem;">
                                        <th>Tanggal</th>
                                        <th>Aktivitas</th>
                                        <th>Keterangan</th>
                                        <th class="text-end">point</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($histories as $history)
                                        <tr>
                                            <td class="text-muted small">
                                                {{ $history->created_at->translatedFormat('d M Y, H:i') }} WIB
                                            </td>

                                            <td>
                                                @if ($history->activity_type === 'booking')
                                                    <span class="badge bg-light-primary text-primary px-2 py-1"
                                                        style="border-radius: 6px;">
                                                        <i class="ti ti-calendar-event me-1"></i> Lapangan
                                                    </span>
                                                @elseif($history->activity_type === 'join_community')
                                                    <span class="badge bg-light-info text-info px-2 py-1"
                                                        style="border-radius: 6px;">
                                                        <i class="ti ti-users me-1"></i> Komunitas
                                                    </span>
                                                @elseif($history->activity_type === 'challenge_completed')
                                                    <span class="badge bg-light-success text-success px-2 py-1"
                                                        style="border-radius: 6px;">
                                                        <i class="ti ti-award me-1"></i> Tantangan
                                                    </span>
                                                @else
                                                    <span class="badge bg-light-secondary text-secondary px-2 py-1"
                                                        style="border-radius: 6px;">
                                                        Lainnya
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <h6 class="mb-0 text-dark small fw-medium">{{ $history->description }}</h6>
                                            </td>

                                            <td class="text-end">
                                                @if ($history->amount >= 0)
                                                    <span
                                                        class="text-success fw-bold">+{{ number_format($history->amount) }}
                                                        pts</span>
                                                @else
                                                    <span class="text-danger fw-bold">{{ number_format($history->amount) }}
                                                        pts</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                <i class="ti ti-info-circle d-block mb-2 text-secondary"
                                                    style="font-size: 1.5rem;"></i>
                                                Belum ada riwayat perolehan poin.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if ($histories->hasPages())
                        <div class="card-footer bg-transparent border-0 pt-0 px-3 pb-3">
                            {{ $histories->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
