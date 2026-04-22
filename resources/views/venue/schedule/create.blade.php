@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Jadwal Rutin</h5>
            </div>

            <div class="card-body">

                {{-- ALERT SUCCESS --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- VALIDATION ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('venue.schedule.store') }}" method="POST">
                    @csrf

                    {{-- MEMBER --}}
                    <div class="mb-3">
                        <label class="form-label">Member</label>
                        <select name="member_id" class="form-control" required>
                            <option value="">-- Pilih Member --</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->nama_club }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- COURT --}}
                    <div class="mb-3">
                        <label class="form-label">Court</label>
                        <select name="court_id" class="form-control" required>
                            <option value="">-- Pilih Court --</option>
                            @foreach ($courts as $court)
                                <option value="{{ $court->id }}" {{ old('court_id') == $court->id ? 'selected' : '' }}>
                                    {{ $court->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- TANGGAL --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control"
                                required>
                        </div>
                    </div>

                    {{-- JAM --}}
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" name="start_time" value="{{ old('start_time') }}" class="form-control"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" name="end_time" value="{{ old('end_time') }}" class="form-control"
                                required>
                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="alert alert-info mt-3">
                        Jadwal akan dibuat <b>setiap minggu</b> dari tanggal mulai sampai tanggal selesai.
                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Simpan Jadwal
                        </button>

                        <a href="{{ route('venue.schedule.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
