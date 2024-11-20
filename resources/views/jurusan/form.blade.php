@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Form Tambah Jurusan</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2 px-4 mt-4">
                    <form action="{{ route(!empty($data) ? 'jurusan.update' : 'jurusan.store', $data->id ?? '') }}" method="POST" class="row g-3" id="form-add-surat">
                        @csrf
                        @if (!empty($data))
                            @method('PUT')
                        @endif
                        <div class="col-md-6 form-group">
                          <label for="nama" class="form-label">Nama</label>
                          <input type="text" id="nama" name="nama" placeholder="Masukan Nama Jurusan" class="form-control" value="{{ old('nama', $data->nama ?? '') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="singkatan" class="form-label">Singkatan</label>
                          <input type="text" id="singkatan" name="singkatan" placeholder="Masukan Singkatan Jurusan" class="form-control" value="{{ old('singkatan', $data->singkatan ?? '') }}" required>
                        </div>

                        <div class="col-12 text-end">
                          <a href="{{ url('master-data/jurusan') }}" class="btn btn-danger" type="button">Kembali</a>
                          <button type="submit" class="btn btn-success">{{ !empty($data->id) ? 'Update' : 'Simpan'}}</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
