@extends('layouts.mantis')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 mt-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white pb-0 pt-4 border-0">
                    <h4 class="card-title fw-bold text-dark mb-1">Registrasi Venue</h4>
                    <p class="text-muted small">Silakan lengkapi informasi usaha lapangan olahraga Anda.</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('venue.store') }}">
                        @csrf

                        {{-- Field Nama Usaha --}}
                        <div class="mb-3">
                            <label for="business_name" class="form-label fw-semibold">Nama Usaha</label>
                            <input type="text" class="form-control @error('business_name') is-invalid @enderror"
                                id="business_name" name="business_name" placeholder="Contoh: Lumajang Sports Arena"
                                value="{{ old('business_name') }}" required>
                            @error('business_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Field Nomor Handphone --}}
                        <div class="mb-3">
                            <label for="phone_number" class="form-label fw-semibold">Nomor Handphone / WhatsApp</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                id="phone_number" name="phone_number" placeholder="Contoh: 081234567890"
                                value="{{ old('phone_number') }}" required>
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Field Alamat --}}
                        <div class="mb-4">
                            <label for="address" class="form-label fw-semibold">Alamat Lengkap</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                placeholder="Masukkan alamat lengkap venue Anda" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="d-grid mt-2">
                            <button type="submit" class="btn btn-primary fw-bold py-2">
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
