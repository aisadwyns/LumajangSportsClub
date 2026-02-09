@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Form Edit Event</h4>
                <a href="{{ route('events.index') }}">Kembali</a>
            </div>

            <div class="card-body">
                {{-- Alert Validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Judul --}}
                        <div class="col-md-6 mb-2">
                            <label>Judul Event</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $event->title) }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Jenis Komunitas --}}
                        <div class="col-md-6 mb-2">
                            <label>Jenis Komunitas</label>
                            <select name="jenis_komunitas_id"
                                class="form-control @error('jenis_komunitas_id') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                @foreach ($jenisKomunitas as $jk)
                                    <option value="{{ $jk->id }}"
                                        {{ old('jenis_komunitas_id', $event->jenis_komunitas_id) == $jk->id ? 'selected' : '' }}>
                                        {{ $jk->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_komunitas_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12 mb-2">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="2" class="form-control @error('description') is-invalid @enderror">{{ old('description', $event->description) }}</textarea>
                        </div>

                        {{-- Thumbnail --}}
                        <div class="col-md-6 mb-2">
                            <label>Thumbnail</label>
                            <input type="file" name="thumbnail"
                                class="form-control @error('thumbnail') is-invalid @enderror">
                            @error('thumbnail')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            @if ($event->thumbnail)
                                <img src="{{ asset('storage/thumbnail_event/' . $event->thumbnail) }}" width="100"
                                    class="mt-2">
                            @endif
                        </div>

                        {{-- Tanggal --}}
                        <div class="col-md-6 mb-2">
                            <label>Tanggal Event</label>
                            <input type="date" name="event_date"
                                class="form-control @error('event_date') is-invalid @enderror"
                                value="{{ old('event_date', $event->event_date) }}">
                            @error('event_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Jam Mulai --}}
                        <div class="col-md-6 mb-2">
                            <label>Jam Mulai</label>
                            <input type="time" name="start_time"
                                class="form-control @error('start_time') is-invalid @enderror"
                                value="{{ old('start_time', $event->start_time) }}">
                        </div>

                        {{-- Jam Selesai --}}
                        <div class="col-md-6 mb-2">
                            <label>Jam Selesai</label>
                            <input type="time" name="end_time"
                                class="form-control @error('end_time') is-invalid @enderror"
                                value="{{ old('end_time', $event->end_time) }}">
                        </div>

                        {{-- Lokasi --}}
                        <div class="col-md-6 mb-2">
                            <label>Lokasi</label>
                            <input type="text" name="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location', $event->location) }}">
                        </div>

                        {{-- Link Registrasi --}}
                        <div class="col-md-6 mb-2">
                            <label>Link Registrasi</label>
                            <input type="url" name="registration_link"
                                class="form-control @error('registration_link') is-invalid @enderror"
                                value="{{ old('registration_link', $event->registration_link) }}">
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-2">
                            <label>Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>
                                    Draft</option>
                                <option value="published"
                                    {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3 text-end">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
