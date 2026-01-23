@extends('layouts.mantis')
@section('content')
    <div class="">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <div class="card-title">
                    <h4>Daftar Users</h4>
                </div>
                <div>

                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>nama lengkap</th>
                            <th>email</th>
                            <th>Role</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->role?->role_name }}</td>
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#roleModal{{ $data->id }}"> Ganti Role</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @foreach ($users as $data)
        <div class="modal fade" id="roleModal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Pilih Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="my-2">Mengganti role dapat mengubah hak akses pengguna</p>
                        <form action="{{ route('users.update-role') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $data->id }}">
                            <div><label for="role_id">Tentukan Role</label>
                                <select class="form-select" name="role_id" id="role_id"
                                    aria-label="Default select example">
                                    <option selected>Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <<option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="w-100 my-3 btn btn-primary"> Ganti</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
