@extends('layouts.user_type.guest')

@section('content')
<div class="container-siswa">
    <div class="text-center w-100">
        <div class="logo mt-6">
            <img src="{{ asset('assets/img/logos/yayasan.png') }}" height="98.86" class="mx-2" />
            <img src="{{ asset('assets/img/logos/angkasa.png') }}" height="98.86" class="mx-2" />
        </div>
        <div class="container-pengumuman rounded mt-4">
            <div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="color:">
                                        Perusahaan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="color:">
                                        Alamat
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="color:">
                                      Jurusan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data) === 0)
                                    <tr class="text-center"><td class="dataTables-empty" colspan="12">Tidak ada data</td></tr>
                                @else
                                @foreach ($data as $perusahaan )
                                    <tr>
                                        <td class="px-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $perusahaan->nama }}</p>
                                        </td>
                                        <td class="px-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $perusahaan->alamat }}</p>
                                        </td>
                                        <td class="px-4">
                                            <p class="text-xs font-weight-bold mb-0"><a href="{{ $perusahaan->website }}" target="_blank" class="link-info">Lihat Website</a></p>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button id="ajukanbtn" class="btn bg-gradient-danger btn-sm me-1" onclick="window.location.href='{{ route('program') }}'">Kembali</button>
        </div>
    </div>
</div>

<script>
    localStorage.removeItem('Read');
</script>


@endsection
