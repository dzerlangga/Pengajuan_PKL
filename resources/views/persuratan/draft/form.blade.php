@extends('layouts.user_type.auth')

@section('content')

   {{-- MODAL --}}
   <div class="modal fade" id="anggotaModal" aria-hidden="true" aria-labelledby="anggotaModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="anggotaModalLabel">Tambah Anggota</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="formAnggota">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control input-anggota" id="nama" aria-describedby="namaHelp">
                  <div id="namaHelp" class="form-text">Pastikan nama sudah benar</div>
                </div>
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" name="nis" class="form-control input-anggota" id="nis" aria-describedby="nisHelp">
                    <div id="nisHelp" class="form-text">Pastikan NIS sudah benar</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-gradient-success">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>
{{-- END MODAL --}}

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Form Tambah Surat Pengajuan</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2 px-4 mt-4">
                    <form action="{{ route('surat.store') }}" method="POST" class="row g-3" id="form-add-surat">
                        @csrf
                        <div class="col-md-6 form-group">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select id="jurusan" name="jurusan" class="form-select" required>
                              <option value="" selected disabled>Pilih Jurusan</option>
                              @foreach ($jurusan as $value)
                                  <option value="{{$value->id}}"
                                    @isset($data)
                                      {{ $data->jurusan_id === $value->id ? 'selected' : '' }}
                                    @endisset>
                                  {{ $value->nama }}
                                  </option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-6 form-group">
                            <label for="no_hp" class="form-label">No HP/WA</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', $data->no_hp ?? '') }}" required>
                          </div>
                        <div class="col-md-12 form-group">
                          <label for="inputEmail4" class="form-label">Nama Perusahaan (Harus Lengkap)</label>
                          <input type="text" id="nama_perusahaan" name="perusahaan" class="form-control" value="{{ old('perusahaan', $data->perusahaan ?? '') }}" required>
                          <span class="info">(contoh : PT Baraya Telematika, contoh : Bengkel Rahmat Putra )</span>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="alamat" class="form-label">Alamat Perusahaan (Harus Lengkap)</label>
                            <textarea id="alamat" name="alamat" class="form-control" required>{{ old('alamat', $data->alamat ?? '') }}</textarea>
                            <span class="info">(contoh : Jl. Sukasari no 12/78 Kel Gaga Kec Cijawura Kota Bandung)</span>
                        </div>

                        <hr />

                        <div class="d-flex flex-row justify-content-between">
                            <div class="text-start">
                                <h6 class="mb-0">Daftar Anggota PKL</h6>
                            </div>
                            <a href="#" id="tambah_button" class="btn bg-gradient-success btn-sm mb-0" type="button" data-bs-target="#anggotaModal" data-bs-toggle="modal">+&nbsp; Tambah Anggota</a>
                        </div>
                        <div class="table-responsive p-0">
                            <div class="w-100 text-start px-4">
                                <span class="text-danger text-start" style="font-size: 10px">*MAX ANGGOTA ADALAH 6 ORANG</span>
                            </div>
                            <table class="table align-items-center mb-0" id="table-anggota">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NIS
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                          Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="body_table">
                                    <tr class="text-center"><td class="dataTables-empty" colspan="12">Tidak ada data</td></tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12">
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let anggotaModal = $('#anggotaModal');
    let form_anggota = $('#formAnggota');
    let table_anggota = $('#table-anggota');
    let body_table = $('#body_table');
    let inputs = document.querySelectorAll('.input-anggota');
    let data_anggota = {!! json_encode($data->anggota ?? []) !!}

    if ({!! json_encode($data->anggota ?? []) !!}) {
        renderTable()
    }

    anggotaModal.on('hidden.bs.modal', function () {
        inputs.forEach(function(input) {
          input.value = ''; // Mengosongkan nilai elemen
        });
    })

    // FUNTION DELETE ANGGOTA BY ROW
    table_anggota.on('click', '.del-anggota', function() {
        let nis = $(this).attr('id')
        let filter = data_anggota.filter(e=> e.nis !== nis)
        data_anggota = filter
        var rowIndex = $(this).closest('tr').index();
        $('#table-anggota tbody tr').eq(rowIndex).remove();
        if (data_anggota.length < 6 ) button('add','show')
        if (data_anggota.length === 0 ) {
            body_table.html('<tr class="text-center"><td class="dataTables-empty" colspan="3">Belum ada anggota yang ditambah</td></tr>')
            button('next', 'disable')
        }
    });

    form_anggota.on('submit', function (event) {
        event.preventDefault();
        let data = {
            nama: '',
            nis: ''
        }
        inputs.forEach(function(input) {
            data[input.name] = input.value
        });

        if (data.nama === '' || data.nis === '') {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Data belum di masukan',
                    icon: 'warning',
                    confirmButtonText: 'Tutup'
                    })
                return
            }

        if (data_anggota.find(e=> e.nis === data.nis)) {
            Swal.fire({
                    title: 'Peringatan!',
                    text: 'NIS telah ada!',
                    icon: 'warning',
                    confirmButtonText: 'Tutup'
                    })
            return
        }
        data_anggota = [...data_anggota, data]
        anggotaModal.modal('hide')
        renderTable(data)
    })

    document.getElementById("form-add-surat").addEventListener("submit", function(event) {
        if (data_anggota.length === 0) {
            Swal.fire({
                    title: 'Peringatan!',
                    text: 'Data anggota masih kosong!',
                    icon: 'warning',
                    confirmButtonText: 'Tutup'
                    })
            event.preventDefault(); // Mencegah form terkirim
            return
        }
    });

    function renderTable() {
            let html = ''
            data_anggota.map((e,index)=>{
                html +=`
                <tr>
                    <td class="ps-4">
                        <p class="text-xs font-weight-bold mb-0">${e.nama}</p>
                        <input type="hidden" name="anggota[${index}][nama]" value="${e.nama}" />
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${e.nis}</p>
                        <input type="hidden" name="anggota[${index}][nis]" value="${e.nis}" />
                    </td>
                    <td class="text-center">
                        <span class="del-anggota" id="${e.nis}">
                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                        </span>
                    </td>
                </tr>
                `
            })
            body_table.html(html)

            if (data_anggota.length === 6) {
                button('add','hide')
            }
    }


</script>

@endsection
