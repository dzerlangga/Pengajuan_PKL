@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Form Tambah Perusahaan</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2 px-4 mt-4">
                    <form action="{{ route(!empty($data) ? 'perusahaan.update' : 'perusahaan.store', $data->id ?? '') }}" method="POST" class="row g-3" id="form-add-surat">
                        @csrf
                        @if (!empty($data))
                            @method('PUT')
                        @endif
                        <div class="col-md-6 form-group">
                          <label for="nama" class="form-label">Nama</label>
                          <input type="text" id="nama" name="nama" placeholder="Masukan Nama Perusahaan" class="form-control" value="{{ old('nama', $data->nama ?? '') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="alamat" class="form-label">Alamat</label>
                          <input type="text" id="alamat" name="alamat" placeholder="Masukan Alamat Perusahaan" class="form-control" value="{{ old('alamat', $data->alamat ?? '') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="kontak" class="form-label">Kontak</label>
                          <input type="text" id="kontak" name="kontak" placeholder="Masukan Kontak Perusahaan" class="form-control" value="{{ old('kontak', $data->kontak ?? '') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="website" class="form-label">Website</label>
                          <input type="text" id="website" name="website" placeholder="Masukan Alamat Website Perusahaan" class="form-control" value="{{ old('website', $data->website ?? '') }}">
                        </div>
                        <div class="col-12 text-end">
                          <a href="{{ url('master-data/perusahaan') }}" class="btn btn-danger" type="button">Kembali</a>
                          <button type="submit" class="btn btn-success">{{ !empty($data->id) ? 'Update' : 'Simpan'}}</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
