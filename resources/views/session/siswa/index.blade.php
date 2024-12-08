@extends('layouts.user_type.guest')

@section('content')

<style>
    .fade-out {
        opacity: 1;
        transition: opacity 1s ease; /* Animasi opacity selama 1 detik */
    }

    .fade-out-hidden {
        opacity: 0; /* Menghilangkan elemen */
    }
</style>

<div class="container-siswa">
    <div class="text-center w-100">
        <div class="logo mt-6">
            <img src="{{ asset('assets/img/logos/yayasan.png') }}" height="98.86" class="mx-2" />
            <img src="{{ asset('assets/img/logos/angkasa.png') }}" height="98.86" class="mx-2" />
        </div>
        <div class="container-pengumuman rounded mt-4">
            @if(session('success'))
                <div class="alert alert-success fade-out text-white" id="alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div>
                {!! $text ? nl2br(htmlspecialchars_decode($text)) : 'MAAF TIDAK ADA PENGUMUMAN YANG TERSEDIA.' !!}
            </div>
            @if ($text)
            <div class="form-check">
                <input style="appearance: auto" type="checkbox" class="form-check-input" id="read" name="read">
                <label for="read" class="text-danger">TELAH DIBACA</label><br>
            </div>
            <div class="text-center mt-4">
                <button id="rekomendasibtn" class="btn bg-gradient-info btn-sm me-1" onclick="window.location.href='{{ route('rekomendasi') }}'">REKOMENDASI</button>
                <button id="ajukanbtn" class="btn bg-gradient-secondary btn-sm btn-siswa-disable me-1" onclick="window.location.href='{{ route('formPengajuan') }}'">AJUKAN</button>
            </div>
            @endif
        </div>
    </div>
</div>


<script>
    localStorage.removeItem('Read');
    const tabKey = 'app-tab-opened';
    const selectElement = document.querySelector("#read");
    const ajukanbtn = document.getElementById("ajukanbtn");
    let read_status = false

       // Periksa jika ada tab lain yang sudah terbuka
       if (localStorage.getItem(tabKey)) {
           alert('Aplikasi ini sudah dibuka di tab lain. Hanya satu tab yang diizinkan.');
           window.location.href = "about:blank"; // Menutup tab yang baru dibuka (opsional)
        } else {
            // Tandai tab ini sebagai tab yang aktif
            localStorage.setItem(tabKey, 'true');
        }

        // Hapus tanda jika tab ini ditutup
        window.addEventListener('beforeunload', () => {
            localStorage.removeItem(tabKey);
        });

        // Memastikan bahwa ketika tab lain dibuka, peringatan akan muncul
        window.addEventListener('storage', (event) => {
            if (event.key === tabKey && event.newValue === 'true') {
                alert('Aplikasi ini sudah dibuka di tab lain. Hanya satu tab yang diizinkan.');
                window.close(); // Menutup tab yang baru dibuka (opsional)
            }
        });

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

    selectElement.addEventListener("change", function() {
        localStorage.setItem("Read", this.checked);
        if (this.checked) {
            ajukanbtn.classList.toggle('btn-siswa-disable')
            ajukanbtn.classList.remove('bg-gradient-secondary')
            ajukanbtn.classList.add('bg-gradient-info')
            return
        }
        ajukanbtn.classList.toggle('btn-siswa-disable')
        ajukanbtn.classList.remove('bg-gradient-info')
        ajukanbtn.classList.add('bg-gradient-secondary')
    });

</script>

@endsection
