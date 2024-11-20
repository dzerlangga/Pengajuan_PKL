@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success fade-out text-white" id="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Perusahaan</h5>
                        </div>
                        <a href="{{ url('master-data/perusahaan/add') }}"  class="btn bg-gradient-info btn-sm mb-0" type="button">+&nbsp; Tambah Perusahaan</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Alamat
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kontak
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Website
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($perusahaan) === 0)
                                    <tr class="text-center"><td class="dataTables-empty" colspan="5">Tidak ada data</td></tr>
                                @else
                                @foreach ($perusahaan as $data )
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $data->nama }}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $data->alamat }}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $data->kontak }}</p>
                                    </td>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0"><a href="{{ $data->website }}" target="_blank" class="link-info">{{ $data->website }}</a></p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('master-data/perusahaan/edit/'.$data->id ) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Detail data">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Hapus data" onclick="deleted(event,{{ $data->id }})">
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </a>
                                        <form action="{{ route('perusahaan.delete', $data->id) }}" method="POST" id="deleteForm{{ $data->id }}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        var alert = document.getElementById('alert-success');
        if (alert) {
            setTimeout(function() {
                alert.classList.add('fade-out-hidden'); // Menambahkan kelas untuk efek fade-out
                setTimeout(function() {
                    alert.style.display = 'none'; // Menghilangkan alert setelah animasi selesai
                }, 1000); // Waktu yang sama dengan durasi transisi CSS
            }, 5000); // 5000 ms = 5 detik
        }
    };

    function deleted(e,id) {
      Swal.fire({
        icon: "warning",
        title: "Apakah data ini akan dihapus?",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        confirmButtonColor: "#5a9adb",
      }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Data Berhasil Dihapus!", "", "success");
            $(`#deleteForm${id}`).submit()
        }
      });
      e.preventDefault();
    }
</script>

@endsection
