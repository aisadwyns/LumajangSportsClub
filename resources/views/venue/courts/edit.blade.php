@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-item-center">
                <h4 class="card-title">Edit Data Court</h4>
                <div>
                    <a href="{{ route('venue.court.index') }}">kembali</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('venue.court.update', $court->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama Court --}}
                    <div class="form-group my-2">
                        <label>Nama Court</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $court->name) }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Jenis Olahraga --}}
                    <div class="form-group my-2">
                        <label>Jenis Olahraga</label>
                        <select name="sport_type" class="form-control @error('sport_type') is-invalid @enderror">

                            <option value="">-- Pilih Jenis Olahraga --</option>

                            @foreach ($jenis as $j)
                                <option value="{{ $j->nama_jenis }}"
                                    {{ old('sport_type', $court->sport_type) == $j->nama_jenis ? 'selected' : '' }}>
                                    {{ $j->nama_jenis }}
                                </option>
                            @endforeach

                        </select>

                        @error('sport_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- type court --}}
                    <div class="form-group my-2">
                        <label for="court_type">Tipe Court</label>

                        <select name="court_type" class="form-control @error('court_type') is-invalid @enderror">
                            <option value="">-- Pilih Tipe Court --</option>

                            <option value="indoor" {{ old('court_type') == 'indoor' ? 'selected' : '' }}>
                                Indoor
                            </option>

                            <option value="outdoor" {{ old('court_type') == 'outdoor' ? 'selected' : '' }}>
                                Outdoor
                            </option>
                        </select>

                        @error('court_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="form-group my-2">
                        <label>Harga per Jam</label>
                        <input type="number" name="price_per_hour"
                            class="form-control @error('price_per_hour') is-invalid @enderror"
                            value="{{ old('price_per_hour', $court->price_per_hour) }}">
                        @error('price_per_hour')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group my-2">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $court->description) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Fasilitas --}}
                    <div class="form-group my-2">
                        <label>Fasilitas</label>
                        <textarea name="facilities" class="form-control @error('facilities') is-invalid @enderror">{{ old('facilities', $court->facilities) }}</textarea>
                        @error('facilities')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Gambar --}}
                    <div class="form-group my-2">
                        <label>Gambar</label><br>

                        @if ($court->image)
                            <img src="{{ asset('storage/court/' . $court->image) }}" width="120" class="mb-2">
                        @endif

                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Jam --}}
                    <div class="form-group my-2">
                        <label>Jam Operasional</label>
                        <div class="d-flex gap-2">
                            <input type="time" name="open_time" class="form-control"
                                value="{{ old('open_time', $court->open_time) }}">

                            <input type="time" name="close_time" class="form-control"
                                value="{{ old('close_time', $court->close_time) }}">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group my-2">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ old('status', $court->status) == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ old('status', $court->status) == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                    {{-- Button --}}
                    <div class="my-2 d-flex justify-content-end">
                        <button class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
