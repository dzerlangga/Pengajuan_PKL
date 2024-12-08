@extends('layouts.user_type.auth')

@section('content')

@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ isset($data) ? "Detail" : "Tambah" }} Program</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 pb-2 px-4 mt-4">
                    <form action="{{ route(!empty($data) ? 'program.update' : 'program.store', $data->id ?? '') }}" method="POST" class="row g-3" id="form-add-surat">
                        @csrf
                        @if (!empty($data))
                            @method('PUT')
                        @endif
                        <div class="col-md-12 form-group">
                          <label for="nama" class="form-label">Nama</label>
                          <input type="text" id="nama" name="nama" placeholder="Masukan Nama Program" class="form-control" value="{{ old('nama', $data->nama ?? '') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="start_date" class="form-label">Tanggal Mulai</label>
                          <input type="date" id="start_date" name="start_date" placeholder="Pilih Tanggal" class="form-control" value="{{ old('start_date', isset($data->start_date) ? Carbon::parse($data->start_date)->translatedFormat('Y-m-d') : '') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="end_date" class="form-label">Tanggal Selesai</label>
                          <input type="date" id="end_date" name="end_date" placeholder="Pilih Tanggal" class="form-control" value="{{ old('end_date', isset($data->end_date) ? Carbon::parse($data->end_date)->translatedFormat('Y-m-d') : '') }}" required>
                        </div>
                        <div class="col-md-12 form-group">
                          <label for="singkatan" class="form-label">Pengumuman</label>

                          <div id="editor" style="height: auto">
                              {!! !empty($data) ? html_entity_decode(htmlspecialchars($data->pengumuman)) : '' !!}
                          </div>
                          <input type="hidden" id="pengumuman" name="pengumuman" placeholder="Masukan Nama Program" class="form-control" value="{{ old('pengumuman', $data->pengumuman ?? '') }}" required>

                        </div>

                        <div class="col-12 text-end">
                          <a href="{{ url('master-data/program') }}" class="btn btn-danger" type="button">Kembali</a>
                          <button type="submit" class="btn btn-success">{{ !empty($data->id) ? 'Update' : 'Simpan'}}</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('js/quill.min.js') }}"></script>

<script>
    var quill = new Quill('#editor', {
        theme: 'snow' // Specify theme in configuration
    });

      quill.on('text-change', function name(params) {
        let content = quill.root.innerHTML;
        $('#pengumuman').val(content)
      })
</script>


@endsection
