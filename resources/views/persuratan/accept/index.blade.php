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
                            <h5 class="mb-0">Surat Diterima</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Perusahaan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Alamat
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                      Jurusan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                      Tanggal dibuat
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($surat) === 0)
                                    <tr class="text-center"><td class="dataTables-empty" colspan="12">Tidak ada data</td></tr>
                                @else
                                @foreach ($surat as $data )
                                    <tr>
                                        <td class="px-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->perusahaan }}</p>
                                        </td>
                                        <td class="px-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->alamat ?? '-' }}</p>
                                        </td>
                                        <td class="px-4">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $data->jurusan->nama }} ({{ $data->jurusan->singkatan }})
                                            </p>
                                        </td>
                                        <td class="px-4">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                                            </p>
                                        </td>
                                        <td class="text-center px-4">
                                            <a href="{{ url('pdf/'.$data->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Download PDF">
                                                <i class="fa fa-solid fa-file-pdf text-secondary"></i>
                                            </a>
                                            <a href="{{ url('persuratan/surat-accept/edit/'.$data->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Detail data">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
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
</script>

@endsection
