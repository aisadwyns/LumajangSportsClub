@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-item-center">
                <h4 class="card-title">Form Data Court</h4>
                <div>
                    <a href="{{ route('venue.court.index') }}">kembali</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('venue.court.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Court --}}
                    <div class="form-group my-2">
                        <label for="name">Nama Court</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Sport --}}
                    {{-- Jenis Olahraga --}}
                    <div class="form-group my-2">
                        <label for="sport_type">Jenis Olahraga</label>

                        <select name="sport_type" class="form-control @error('sport_type') is-invalid @enderror">

                            <option value="">-- Pilih Jenis Olahraga --</option>

                            @foreach ($jenis as $j)
                                <option value="{{ $j->nama_jenis }}"
                                    {{ old('sport_type') == $j->nama_jenis ? 'selected' : '' }}>
                                    {{ $j->nama_jenis }}
                                </option>
                            @endforeach

                        </select>

                        @error('sport_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Court Type --}}
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
                        <label for="price_per_hour">Harga per Jam</label>
                        <input type="number" name="price_per_hour" id="price_per_hour"
                            class="form-control @error('price_per_hour') is-invalid @enderror"
                            value="{{ old('price_per_hour') }}">
                        @error('price_per_hour')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group my-2">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Fasilitas --}}
                    <div class="form-group my-2">
                        <label for="facilities">Fasilitas</label>
                        <textarea name="facilities" id="facilities" class="form-control @error('facilities') is-invalid @enderror">{{ old('facilities') }}</textarea>
                        @error('facilities')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Gambar --}}
                    <div class="form-group my-2">
                        <label>Upload Gambar (Max 5)</label>

                        <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">

                        @error('images.*')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div id="previewContainer" class="d-flex gap-2 flex-wrap mt-2"></div>
                    </div>

                    {{-- Jam --}}
                    <div class="form-group my-2">
                        <label>Jam Operasional</label>
                        <div class="d-flex gap-2">
                            <input type="time" name="open_time"
                                class="form-control @error('open_time') is-invalid @enderror"
                                value="{{ old('open_time') }}">
                            <input type="time" name="close_time"
                                class="form-control @error('close_time') is-invalid @enderror"
                                value="{{ old('close_time') }}">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group my-2">
                        <label for="status">Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <div class="my-2 d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('images').addEventListener('change', function(event) {
                const files = event.target.files;
                const container = document.getElementById('previewContainer');

                container.innerHTML = '';

                if (files.length > 5) {
                    alert('Maksimal 5 gambar!');
                    event.target.value = '';
                    return;
                }

                Array.from(files).forEach(file => {
                    if (!file.type.startsWith('image/')) return;

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '8px';
                        img.style.border = '1px solid #ddd';

                        container.appendChild(img);
                    };

                    reader.readAsDataURL(file);
                });
            });
        </script>
    @endpush
@endsection
