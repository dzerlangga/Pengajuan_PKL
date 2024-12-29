<div id="loadingSpinner" style="background-color:#00000042;display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; width:100%; height: 100vh">
    <div style="position: fixed; top: 50%; left: 50%;" class="spinner-grow text-warning" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

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
                        {{-- {{ $data->jurusan_nama }} ({{ $data->jurusan_singkatan }}) --}}
                        {{ $data->jurusan->nama }} ({{ $data->jurusan->singkatan }})
                    </p>
                </td>
                <td class="px-4">
                    <p class="text-xs font-weight-bold mb-0">
                        {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                    </p>
                </td>
                <td class="text-center px-4">
                    <a onclick="downloadPDF(event,'{{ url('pdf/'.$data->id) }}')" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Download PDF" style="cursor: pointer">
                        <i class="fa fa-solid fa-file-pdf text-secondary"></i>
                    </a>
                    <a href="{{ url('persuratan/surat-accept/edit/'.$data->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Detail data">
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

 <script>
    function downloadPDF(event, url) {
        event.preventDefault(); // Mencegah default behavior link sementara
        const loadingSpinner = document.getElementById('loadingSpinner');
        loadingSpinner.style.display = 'block'; // Tampilkan spinner

        // Redirect ke URL setelah beberapa waktu (atau langsung tanpa delay)
        setTimeout(() => {
            loadingSpinner.style.display = 'none'; // Tampilkan spinner
            window.location.href = url;
        }, 500); // Delay opsional (500ms)
    }
</script>

