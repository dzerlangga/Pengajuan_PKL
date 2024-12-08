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
        @if (count($datas) === 0)
         <tr class="text-center"><td class="dataTables-empty" colspan="3">Tidak ada data</td></tr>
        @else
            @foreach ($datas as $data )
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
 {{-- Pagination --}}
 <div style="justify-self: right" class="me-4 mt-4">
  {!! $datas->links() !!}
 </div>
