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
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jersey</th>
                            <th>Gambar</th>

                            <th>Opsi</th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($jerseys as $index => $data)
                            <tr>
                                @csrf
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->image }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $data->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $data->id }}">
                                            <li> <form action="{{ route('jersey.destroy', $data->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="dropdown-item text-danger" data-confirm-delete="true">
        Hapus
    </button>
</form></li>
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
@endsection
