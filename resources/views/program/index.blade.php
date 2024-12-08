@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Program</h5>
                        </div>
                        <a href="{{ url('master-data/program/add') }}" class="btn bg-gradient-info btn-sm mb-0" type="button">+&nbsp; Tambah Program</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <!-- Form Pencarian -->
                    <div class="col-md-3 form-group mb-3 px-3 pt-3">
                        <input type="text" id="search" name="search" placeholder="Cari Data..." class="form-control">
                      </div>
                    <div class="table-responsive p-0" id="data-container">
                        @include('program.table', ['datas' => $datas])
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

    function updateOrderStatus(index,orderId,props) {
        let newStatus = props.getAttribute("value_status");
        let status = parseInt(newStatus, 2) === 1 ? 0 : 1;
        let tagIdStatus = $(`#statusLabel${index}`)
        let iconStatus = $(`#icon${index}`)

        Swal.fire({
        icon: "warning",
        title: `Apakah data ini akan ${status === 1 ? 'Di Aktifkan' : 'Di NonAktifkan'}?`,
        showCancelButton: true,
        confirmButtonText: status === 1 ? 'Aktifkan' : 'NonAktifkan',
      }).then((result) => {
        if (result.isConfirmed) {

        $.ajax({
            url: `/master-data/program/status/${orderId}`,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                if (response.statusCode === 200) {
                    if (status === 1) {
                        tagIdStatus.html('Aktif')
                        // Remove css
                        tagIdStatus.removeClass('bg-secondary')
                        iconStatus.removeClass('fa-check-square')
                        // Add css
                        tagIdStatus.addClass('bg-success')
                        iconStatus.addClass('fa-window-close')
                    }else{
                        tagIdStatus.html('Non Aktif')
                        // Remove css
                        tagIdStatus.removeClass('bg-success')
                        iconStatus.removeClass('fa-window-close')
                        // Add css
                        tagIdStatus.addClass('bg-secondary')
                        iconStatus.addClass('fa-check-square')
                    }
                    props.setAttribute("value_status", status)
                }
                Swal.fire(response.message, "", response.status);

            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });

        }
      });

    }

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
