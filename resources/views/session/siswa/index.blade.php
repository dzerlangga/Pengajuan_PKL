@extends('layouts.user_type.guest')

@section('content')
<div class="container-siswa">
    <div class="text-center w-100">
        <div class="logo mt-6">
            <img src="{{ asset('assets/img/logos/yayasan.png') }}" height="98.86" class="mx-2" />
            <img src="{{ asset('assets/img/logos/angkasa.png') }}" height="98.86" class="mx-2" />
        </div>
        <div class="container-pengumuman mt-4">
            <div>
                {!! $text ? nl2br(htmlspecialchars_decode($text)) : 'MAAF TIDAK ADA PENGUMUMAN YANG TERSEDIA.' !!}
            </div>
            @if ($text)
            <div>
                <input type="checkbox" id="read" name="read">
                <label for="read">TELAH DIBACA</label><br>
            </div>
            <div class="text-center mt-4">
                <button id="ajukanbtn" class="btn-siswa btn-siswa-disable btn-secondary-siswa text-white fw-bold me-1" onclick="window.location.href='{{ route('formPengajuan') }}'">AJUKAN</button>
                <button id="rekomendasibtn" class="btn-siswa btn-primary-siswa text-white fw-bold ms-1">REKOMENDASI</button>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    localStorage.removeItem('Read');
    const selectElement = document.querySelector("#read");
    const ajukanbtn = document.getElementById("ajukanbtn");
    let read_status = false

    selectElement.addEventListener("change", function() {
        localStorage.setItem("Read", this.checked);
        if (this.checked) {
            ajukanbtn.classList.toggle('btn-siswa-disable')
            ajukanbtn.classList.remove('btn-secondary-siswa')
            ajukanbtn.classList.add('btn-primary-siswa')
            return
        }
        ajukanbtn.classList.toggle('btn-siswa-disable')
        ajukanbtn.classList.remove('btn-primary-siswa')
        ajukanbtn.classList.add('btn-secondary-siswa')
    });

</script>

@endsection
