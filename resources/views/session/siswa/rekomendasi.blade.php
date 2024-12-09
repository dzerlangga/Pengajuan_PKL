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
                    <!-- Form Pencarian -->
                    <div class="col-md-5 form-group mb-3 px-3 pt-3">
                        <input type="text" id="search" name="search" placeholder="Cari Perusahaan..." class="form-control">
                      </div>
                    <div class="table-responsive p-0" id="data-container">
                        @include('session.siswa.tableRekomendasi', ['datas' => $datas])
                    </div>
                </div>
            </div>
            <button id="ajukanbtn" class="btn bg-gradient-danger btn-sm me-1 mt-5 mb-0 d-flex" style="justify-self: end" onclick="window.location.href='{{ route('program') }}'">Kembali</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    localStorage.removeItem('Read');

    $(document).ready(function () {
            let value_search = ''
            // Event pagination
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href'); // URL dari link pagination
                fetchData(url);
            });

            $('#search').on('change', function (e) {
                setTimeout(() => {
                    e.preventDefault();
                    value_search = e.target.value;
                    const url = `${window.location.href}?search=` + encodeURIComponent(e.target.value);
                    fetchData(url);
                }, 1000);
            });
    });

    function fetchData(url) {
                $.ajax({
                    url: url,
                    type: "GET",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Ini memberitahu server bahwa permintaan adalah AJAX
                    },
                    success: function (data) {
                        $('#data-container').html(data); // Update kontainer data
                    },
                    error: function () {
                        alert('Terjadi kesalahan saat memuat data.');
                    }
                });
    }
</script>


@endsection
