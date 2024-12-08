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
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Mulai
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Selesai
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($program) === 0)
                                 <tr class="text-center"><td class="dataTables-empty" colspan="3">Tidak ada data</td></tr>
                                @else
                                    @foreach ($program as $data )
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $data->nama }}</p>
                                            </td>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $data->start_date }}</p>
                                            </td>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">{{ $data->end_date }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-lg font-weight-bold mb-0">
                                                    <span id="statusLabel{{ $loop->index }}" class="badge {{$data->status ? 'bg-success' : 'bg-secondary'}}">{{$data->status ? 'Aktif' : 'Non Aktif'}}</span>
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" onclick="updateOrderStatus({{ $loop->index }},{{ $data->id }}, this)" value_status="{{ $data->status }}" data-bs-toggle="tooltip" data-bs-original-title="Active/NonActive data">
                                                    <i id='icon{{ $loop->index }}' class="fas {{$data->status ? 'fa-window-close' : 'fa-check-square'}} text-secondary"></i>
                                                </a>
                                                <a href="{{ url('master-data/program/edit/'.$data->id ) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Detail data">
                                                     <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                <a href="#" data-bs-toggle="tooltip" data-bs-original-title="Hapus data" onclick="deleted(event,{{ $data->id }})">
                                                    <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                </a>
                                                <form action="{{ route('jurusan.delete', $data->id) }}" method="POST" id="deleteForm{{ $data->id }}" style="display: none">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
</script>

@endsection
