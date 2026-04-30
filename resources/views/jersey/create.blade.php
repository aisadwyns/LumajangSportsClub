@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Tambah Katalog Jersey Baru</h4>
                <div>
                    <a href="{{ route('jersey.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('jersey.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Jersey --}}
                    <div class="form-group my-2">
                        <label for="name" class="form-label">Nama Jersey</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name') }}" placeholder="Contoh: Jersey LSC Home 2026">

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Upload Gambar Jersey --}}
                    <div class="form-group my-3">
                        <label for="image" class="form-label">Gambar Jersey</label>
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror" 
                            accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB.</small>

                        @error('image')
                            <br><small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="my-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Jersey
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection