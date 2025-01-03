<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder" style="color:">
                Perusahaan
            </th>
        </tr>
    </thead>
    <tbody>
        @if (count($datas) === 0)
            <tr class="text-center"><td class="dataTables-empty" colspan="12">Tidak ada data</td></tr>
        @else
        @foreach ($datas as $perusahaan )
            <tr>
                <td class="px-4">
                    <p class="text-xs font-weight-bold mb-0">{{ $perusahaan->nama }}</p>
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
