@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Pengumuman</h5>
                        </div>
                        <a href="#" class="btn bg-gradient-info btn-sm mb-0" type="button">+&nbsp; Tambah Pengumuman</a>
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($informasi)
                                    @foreach ($informasi as $data )
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $data->nama }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if ($data->status)
                                                    <i class="far fa-check-circle"></i>
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <span>
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center"><td class="dataTables-empty" colspan="3">Tidak ada data</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
