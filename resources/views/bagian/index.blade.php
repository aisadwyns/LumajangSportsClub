@extends('layouts.mantis')

@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Bagian</h4>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bagian</th>

                            <th>Opsi</th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($bagian as $index => $data)
                            <tr>
                                @csrf
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->nama_bagian }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $data->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $data->id }}">
                                            <li><a class="dropdown-item text-primary"
                                                    href="{{ route('bagian.show', $data->id) }}">
                                                    Detail</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('lapangan.edit', $data->id) }}">Edit</a></li>
                                            <li> <a class="dropdown-item text-danger"
                                                    href="{{ route('bagian.destroy', $data->id) }}"
                                                    data-confirm-delete="true">Hapus</a></li>
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
