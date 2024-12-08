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
                        @include('persuratan.accept.table', ['datas' => $datas])
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
