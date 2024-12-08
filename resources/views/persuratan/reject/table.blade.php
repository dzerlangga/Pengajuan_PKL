<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Perusahaan
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Alamat
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
              Jurusan
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
              Tanggal dibuat
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @if (count($datas) === 0)
            <tr class="text-center"><td class="dataTables-empty" colspan="12">Tidak ada data</td></tr>
        @else
        @foreach ($datas as $data )
            <tr>
                <td class="px-4">
                    <p class="text-xs font-weight-bold mb-0">{{ $data->perusahaan }}</p>
                </td>
                <td class="px-4">
                    <p class="text-xs font-weight-bold mb-0">{{ $data->alamat ?? '-' }}</p>
                </td>
                <td class="px-4">
                    <p class="text-xs font-weight-bold mb-0">
                        {{ $data->jurusan_nama }} ({{ $data->jurusan_singkatan }})
                    </p>
                </td>
                <td class="px-4">
                    <p class="text-xs font-weight-bold mb-0">
                        {{-- {{ $data->created_at ?? '-' }} --}}
                        {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                    </p>
                </td>
                <td class="text-center px-4">
                    <a href="{{ url('persuratan/surat-reject/edit/'.$data->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Detail data">
                        <i class="fas fa-eye text-secondary"></i>
                    </a>
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
