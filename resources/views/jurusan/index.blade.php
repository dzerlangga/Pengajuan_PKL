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
            {{-- Content --}}
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Jurusan</h5>
                        </div>
                        <a href="{{ url('master-data/jurusan/add') }}" class="btn bg-gradient-info btn-sm mb-0" type="button">+&nbsp; Tambah Jurusan</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                     <!-- Form Pencarian -->
                        <div class="col-md-3 form-group mb-3 px-3 pt-3">
                            <input type="text" id="search" name="search" placeholder="Cari Data..." class="form-control">
                          </div>
                    <div class="table-responsive p-0" id="data-container">
                        @include('jurusan.table', ['jurusan' => $jurusan])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
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

