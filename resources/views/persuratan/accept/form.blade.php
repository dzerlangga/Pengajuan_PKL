@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Detail Surat Pengajuan</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 pb-2 px-4 mt-4">
                    <form action="{{ route('surat.store') }}" method="POST" class="row g-3" id="form-add-surat">
                        @csrf
                        <div class="col-md-6 form-group">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select id="jurusan" name="jurusan" class="form-select" disabled required>
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
                            <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', $data->no_hp ?? '') }}" disabled required>
                          </div>
                        <div class="col-md-12 form-group">
                          <label for="inputEmail4" class="form-label">Nama Perusahaan</label>
                          <input type="text" id="nama_perusahaan" name="perusahaan" class="form-control" value="{{ old('perusahaan', $data->perusahaan ?? '') }}" disabled required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="alamat" class="form-label">Alamat Perusahaan</label>
                            <textarea id="alamat" name="alamat" class="form-control" disabled required>{{ old('alamat', $data->alamat ?? '') }}</textarea>
                        </div>

                        <hr />

                        <div class="d-flex flex-row justify-content-between">
                            <div class="text-start">
                                <h6 class="mb-0">Daftar Anggota PKL</h6>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="table-anggota">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NIS
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="body_table">
                                    <tr class="text-center"><td class="dataTables-empty" colspan="12">Tidak ada data</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 text-end">
                            <a href="{{ url('persuratan/surat-accept') }}" class="btn btn-danger">Kembali</a>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let table_anggota = $('#table-anggota');
    let body_table = $('#body_table');
    let inputs = document.querySelectorAll('.input-anggota');
    let data_anggota = {!! json_encode($data->anggota ?? []) !!}
    let id_data = {!! $id ?? '' !!};
    var $ = jQuery.noConflict();

    // fungsi jika data anggota tersedia akan merender ke table yang tersedia
    if ({!! json_encode($data->anggota ?? []) !!}) {
        renderTable()
    }

    // fungsi ketika modal tertutup fieldnya menjadi kosong
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

    // fungsi untuk mengecek form anggota sudah terisi atau belum
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

    // menampilkan semua anggota
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
                </tr>
                `
            })
            body_table.html(html)

            if (data_anggota.length === 6) {
                button('add','hide')
            }
    }

    // update status surat
    function updateStatus(type) {
        let status = type ? 'accept' : 'reject';
        // console.log(status);
        $.ajax({
            url: "{{ route('surat.editStatus', $id ?? '') }}",
            type: 'PUT',
            data: {
                status
            },
            success: function (response) {
                alert(response.message); // Opsional: Menampilkan pesan sukses
                window.location.href = "{{ route('surat',['status'=>'surat-draft']) }}";
            },
            error: function (xhr) {
                alert('Failed to update status');
            }
        });
    }


</script>

@endsection
