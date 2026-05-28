@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Edit Tantangan</h4>
                <div>
                    <a href="{{ route('challenge.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('challenge.update', $challenge->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Judul Tantangan --}}
                    <div class="form-group my-2">
                        <label for="title" class="fw-bold">Judul Tantangan</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $challenge->title) }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tipe/Kriteria Tantangan --}}
                    <div class="form-group my-2">
                        <label for="challenge_type_id" class="fw-bold">Kriteria Trigger Progres</label>
                        <select name="challenge_type_id" id="challenge_type_id"
                            class="form-control @error('challenge_type_id') is-invalid @enderror">
                            @foreach ($challengeTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('challenge_type_id', $challenge->challenge_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }} ({{ $type->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('challenge_type_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        {{-- Target Akumulasi --}}
                        <div class="col-md-4 form-group my-2">
                            <label for="target_amount" class="fw-bold">Target Berapa Kali Selesai</label>
                            <input type="number" name="target_amount" id="target_amount"
                                class="form-control @error('target_amount') is-invalid @enderror"
                                value="{{ old('target_amount', $challenge->target_amount) }}" min="1">
                            @error('target_amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Reward Coin --}}
                        <div class="col-md-4 form-group my-2">
                            <label for="reward_coin" class="fw-bold">Hadiah (Coin)</label>
                            <input type="number" name="reward_coin" id="reward_coin"
                                class="form-control @error('reward_coin') is-invalid @enderror"
                                value="{{ old('reward_coin', $challenge->reward_coin) }}" min="0">
                            @error('reward_coin')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Total Winner --}}
                        <div class="col-md-4 form-group my-2">
                            <label for="total_winner" class="fw-bold">Kuota Pemenang Pertama</label>
                            <input type="number" name="total_winner" id="total_winner"
                                class="form-control @error('total_winner') is-invalid @enderror"
                                value="{{ old('total_winner', $challenge->total_winner) }}" min="1">
                            @error('total_winner')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Start Date --}}
                        <div class="col-md-6 form-group my-2">
                            <label for="start_date" class="fw-bold">Waktu Mulai Kontes</label>
                            <input type="datetime-local" name="start_date" id="start_date"
                                class="form-control @error('start_date') is-invalid @enderror"
                                value="{{ old('start_date', \Carbon\Carbon::parse($challenge->start_date)->format('Y-m-d\TH:i')) }}">
                            @error('start_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- End Date --}}
                        <div class="col-md-6 form-group my-2">
                            <label for="end_date" class="fw-bold">Waktu Berakhir Kontes</label>
                            <input type="datetime-local" name="end_date" id="end_date"
                                class="form-control @error('end_date') is-invalid @enderror"
                                value="{{ old('end_date', \Carbon\Carbon::parse($challenge->end_date)->format('Y-m-d\TH:i')) }}">
                            @error('end_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group my-2">
                        <label for="description" class="fw-bold">Deskripsi / Aturan Main</label>
                        <textarea name="description" id="description" rows="4"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $challenge->description) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="form-group my-2">
                        <label for="status" class="fw-bold">Status Publikasi</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="draft" {{ old('status', $challenge->status) == 'draft' ? 'selected' : '' }}>
                                Draft (Simpan Internal)</option>
                            <option value="active" {{ old('status', $challenge->status) == 'active' ? 'selected' : '' }}>
                                Active (Langsung Rilis ke User)</option>
                            <option value="finished"
                                {{ old('status', $challenge->status) == 'finished' ? 'selected' : '' }}>Finished (Tutup
                                Kompetisi)</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Button Submit --}}
                    <div class="my-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">Update Tantangan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
