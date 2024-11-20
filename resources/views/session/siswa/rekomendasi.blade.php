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
                HALAMAN UNTUK REKOMENDASI PERUSAHAAN
            </div>
            <button id="ajukanbtn" class="btn bg-gradient-info btn-sm me-1" onclick="window.location.href='{{ route('informasi') }}'">Kembali</button>
        </div>
    </div>
</div>

<script>
    localStorage.removeItem('Read');
</script>


@endsection
