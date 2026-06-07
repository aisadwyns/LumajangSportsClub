@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Jersey</h4>
                </div>
                <div><a href="{{ route('jersey.create') }}" class="btn btn-primary">Tambah Jersey</a></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle w-auto" id="table">
                        <thead>
                            <tr>
                                <th style="width: 1%;" class="text-nowrap">No</th>
                                <th style="width: 1%;" class="text-nowrap">Gambar</th>
                                <th class="text-nowrap">Nama Jersey</th>
                                <th style="width: 1%;" class="text-nowrap">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jerseys as $index => $data)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        @if ($data->image)
                                            <img src="{{ asset('storage/jerseys/' . $data->image) }}"
                                                alt="{{ $data->name }}" class="img-fluid rounded object-fit-cover"
                                                style="width: 80px; height: 80px; aspect-ratio: 1 / 1; display: block;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted"
                                                style="width: 80px; height: 80px; font-size: 11px;">
                                                No Image
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-nowrap">{{ $data->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle" type="button"
                                                id="dropdownMenuButton{{ $data->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton{{ $data->id }}">
                                                <li>
                                                    <a href="{{ route('jersey.destroy', $data->id) }}"
                                                        class="dropdown-item text-danger" data-confirm-delete="true">
                                                        Hapus
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
