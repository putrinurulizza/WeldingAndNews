@extends('dashboard.layouts.main')
@section('page-heading', 'User')

@section('content')
    <div class="row">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fa-regular fa-plus me-2"></i>
                Tambah
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card mt-3">
                <div class="card-body">
                    {{-- Table --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        @if ($user->is_admin)
                                            Admin
                                        @else
                                            Operator
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#resetPassword{{ $loop->iteration }}">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $loop->iteration }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus{{ $loop->iteration }}">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Hapus --}}
                                <x-form_modal :id="'modalHapus' . $loop->iteration" title="Hapus User" :route="route('user.destroy', $user->id)" btnTitle="Hapus"
                                    method='delete' primaryBtnStyle="btn-outline-danger" secBtnStyle="btn-secondary">
                                    <p class="fs-6">Apakah anda yakin akan menghapus daftar User
                                        <b>{{ $user->name }}</b> ?
                                    </p>
                                    <div class="alert alert-warning fade show" role="alert">
                                        <i class="fa-duotone fa-triangle-exclamation me-2"></i>
                                        Data User Ini Akan Terhapus!
                                    </div>
                                </x-form_modal>
                                {{-- End Modal Hapus --}}

                                {{-- Modal Edit --}}
                                <x-form_modal :id="'modalEdit' . $loop->iteration" title="Edit User" :route="route('user.update', $user->id)" btnTitle="Edit"
                                    method='put' primaryBtnStyle="btn-outline-warning" secBtnStyle="btn-secondary">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="name" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="name" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username" value="{{ old('username', $user->username) }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="is_admin" class="form-label">Role</label>
                                        <select class="form-select @error('is_admin') is-invalid @enderror" name="is_admin"
                                            id="is_admin">
                                            <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>Operator
                                            </option>
                                        </select>
                                    </div>
                                </x-form_modal>
                                {{-- End Modal Edit --}}

                                {{-- Modal Edit Password --}}
                                <x-form_modal :id="'resetPassword' . $loop->iteration" title="Reset Password" :route="route('user.reset', $user->id)" btnTitle="Reset"
                                    primaryBtnStyle="btn-outline-dark" secBtnStyle="btn-secondary">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password
                                            Baru</label>
                                        <div id="pwd1" class="input-group">
                                            <input type="password"
                                                class="form-control border-end-0 @error('password') is-invalid @enderror"
                                                name="password" id="password" value="{{ old('password') }}" required>
                                            <span class="input-group-text cursor-pointer">
                                                <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                            </span>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password2" class="form-label">Konfirmasi
                                            Password
                                            Baru</label>
                                        <div id="pwd2" class="input-group">
                                            <input type="password"
                                                class="form-control border-end-0 @error('password2') is-invalid @enderror"
                                                name="password2" id="password2" value="{{ old('password2') }}" required>
                                            <span class="input-group-text cursor-pointer">
                                                <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                            </span>
                                            @error('password2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </x-form_modal>
                                {{-- End Modal Edit --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{-- End Table --}}

                    {{-- Modal Add --}}
                    <x-form_modal :id="'createModal'" title="Tambah User" :route="route('user.store')" btnTitle="Simpan"
                        primaryBtnStyle="btn-outline-primary" secBtnStyle="btn-secondary">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="name" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="isAdmin" class="form-label">Role</label>
                            <select class="form-select @error('isAdmin') is-invalid @enderror" name="is_admin"
                                id="isAdmin">
                                <option value="1">Admin
                                </option>
                                <option value="0">Operator
                                </option>
                            </select>
                        </div>
                    </x-form_modal>
                    {{-- End Modal Add --}}
                </div>
            </div>
        </div>
    </div>
@endsection
