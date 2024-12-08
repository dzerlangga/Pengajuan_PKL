@php
    $start_date = \Carbon\Carbon::parse($data_surat->program->start_date)->translatedFormat('d F Y');
    $end_date = \Carbon\Carbon::parse($data_surat->program->end_date)->translatedFormat('d F Y');
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>SURAT PENGAJUAN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .header {
            border-bottom: 5px solid #333;
            padding-bottom: 2px
        }
        .header img {
            height: 160px;
            width: fit-content;
        }
        .middle{
            text-align: center
        }
        .header h6{
            font-size: 0.64rem;
            padding:0;
            margin: 0;
        }
        .header h3{
            font-size: 1.4rem;
            padding:0;
            margin: 0;
        }
        .header h5{
            font-size: 0.6rem;
            padding:0;
            margin: 0;
        }
        .header h4{
            font-size: 0.66rem;
            padding:0;
            margin: 0;
        }
        .main .now-date{
            width: 100%;
            text-align: right;
        }
        .main table tr {
            vertical-align: top
        }
        .pengumuman{
            text-align: justify;
        }

        .text-justy{
            text-align: justify
        }

        .container-company{
            text-align: right
        }
        .company{
            width: max-content;
            display: inline-block;
        }
        .container-company .company .text-yth{
            margin: 10px 10px 0 0;
        }
        .table-siswa{
            text-align: center
        }
        .table-siswa td{
            border: 1px solid black;
            border-bottom: 0px solid black;
            border-top: 0px solid black;
            padding: 0px 3px 0px 3px;
        }

        .signature{
            margin: 0;
            padding: 0;
            width: 100%;
            text-align: right;
        }

        .table-signature{
            margin: 0;
            padding: 0;
            display: inline-block;
        }

    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="header">
        <table width="100%">
            <tr>
                <td class="logo text-center">
                    <img src="{{ public_path('assets/img/logos/yayasan.png') }}" />
                </td>
                <td class="middle">
                    <h6>YAYASAN ARDHYA GARINI PENGURUS CABANG LANUD SULAIMAN</h6>
                    <h3>SMK ANGKASA 1 MARGAHAYU</h3>
                    <h5>Jl. Hercules IV No.01 Lanud Sulaiman Kab. Bandung 40229 Telp. (022) 5416703</h5>
                    <h4>e-mail: smkangkasa1margahayu@gmail.com web: smk-angkasa1.sch.id</h4>
                </td>
                <td class="logo text-center">
                    <img src="{{ public_path('assets/img/logos/angkasa.png') }}" />
                </td>
            </tr>
        </table>
    </div>
    <div class="main">
        <p class="now-date" style="margin: 0; padding: 0"><b>Bandung, {{ $now }} </b></p>
        <table width="60%">
            <tr style="margin: 0;padding:0">
                <td style="margin: 0;padding:0" class="label" width="10%" >Nomor</td>
                <td style="margin: 0;padding:0" width="5%">:</td>
                <td style="margin: 0;padding:0" width="100%"><b>421.5/SMK-A1/700-1/.......-CADISDIKWIL VIII</b></td>
            </tr>
            <tr style="margin: 0;padding:0">
                <td style="margin: 0;padding:0" class="label" width="10%">Lampiran</td>
                <td style="margin: 0;padding:0" width="5%">:</td>
                <td style="margin: 0;padding:0" width="100%"><b>1 (satu) lampiran</b></td>
            </tr>
            <tr style="margin: 0;padding:0">
                <td style="margin: 0;padding:0" class="label" width="10%">Perihal</td>
                <td style="margin: 0;padding:0" width="5%">:</td>
                <td style="margin: 0;padding:0" width="100%"><b>Permohonan Kesediaan<br><u>Menerima Siswa PKL</u></b></td>
            </tr>
        </table>
        <div class="container-company">
            <div class="company">
                <b>
                <table>
                    <tr>
                        <td width="15%" style="vertical-align: middle">Yth.</td>
                        <td>Kepada <br/> Pimpinan <br/> {{ $data_surat->perusahaan }} <br/> di <br/> {{ $data_surat->alamat }} </td>
                    </tr>
                </table>
                </b>
            </div>
        </div>
       <p style="margin: 0;padding:0">Dengan Hormat,</p>
       <ol class="pengumuman" style="margin-bottom: 0;padding-bottom:0">
            <li class="my-3">Dasar.
                <ol type="a">
                    <li>Kurikulum Merdeka SMK Pusat Keunggulan Tahun 2021</li>
                    <li>Program Kerja SMK Angkasa 1 Margahayu Tahun Pelajaran 2025/2026 bidang Hubin tentang Praktek Kerja Lapangan (PKL)</li>
                </ol>
            </li>
            <li class="my-3">
                Sesuai dasar di atas diajukan permohonan kesediaan menerima siswa PKL sebagai sarana meningkatkan keterampilan dan wawasan siswa serta sebagai bentuk pembelajaran secara nyata pada situasi kerja sebenarnya dari pelajaran yang didapat di sekolah. Siswa Kelas XII SMK Angkasa 1 Margahayu diwajibkan melaksanakan praktik kerja lapangan di industri terkait pada tanggal <strong>{{ $start_date }} sampai dengan {{ $end_date }}</strong>. Nama peserta PKL terlampir.
            </li>
            <li class="my-3">
                Demikian atas perhatian dan kerjasamanya serta kesediaannya, kami sampaikan terima kasih.
            </li>
       </ol>

       <div class="signature">
        <div class="table-signature">
            <table width="100%" style="text-align: center">
                <tr>
                    <td>Kepala SMK Angkasa 1 Margahayu</td>
                </tr>
                <tr>
                    <td style="height: 80px">
                    </td>
                </tr>
                <tr>
                    <td>Sutrisno, S.Pd., M.M.Pd. </td>
                </tr>
            </table>
        </div>
       </div>

        <h6 style="font-size: 0.9rem; margin-top: auto">
            <b>Narahubung PKL: Astie Fadilla Putri WA: (085861373792)</b>
        </h6>

        {{-- PAGE 2 --}}
       <div style="page-break-before: always">
        <p style="margin: 0">Lampiran Surat Kepala SMK Angkasa 1 Margahayu</p>
        <table width="100%">
            <tr width="30%">
                <td class="label" width="10%">Nomor</td>
                <td width="5%">:</td>
                <td width="100%"><b>421.5/SMK-A1/700-1/.......-CADISDIKWIL VIII</b></td>
            </tr>
            <tr>
                <td class="label" width="15%">Tanggal</td>
                <td>:</td>
                <td><b>{{ $now }}</b></td>
            </tr>
        </table>
            <p style="margin: 0; padding: 0; margin-top: 30px; text-align:center; font-size: 20px"><b>Lampiran Nama Siswa PKL</b></p>
            <p style="margin: 0; padding: 0; margin-bottom: 10px; text-align:center; font-size: 20px"><b>Rekayasa Perangkat Lunak (RPL)</b></p>

        <table border="1" class="table-siswa" style="border-collapse:collapse">
            <tr>
                <th style="border: 1px solid black">No.</th>
                <th style="border: 1px solid black">Nama</th>
                <th style="border: 1px solid black">No. Induk Siswa</th>
                <th style="border: 1px solid black">Program Studi</th>
                <th style="border: 1px solid black">Keterangan</th>
            </tr>
            @foreach($data_surat->anggota as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $item->nama }} P</td>
                    <td>{{ $item->nis }}</td>
                    @if ($loop->iteration === 1)
                    <td rowspan="{{ count($data_surat->anggota) }}" style="vertical-align: middle">{{ $data_surat->jurusan->nama }}</td>
                    <td rowspan="{{ count($data_surat->anggota) }}" style="vertical-align: middle">{{ $start_date }} sampai dengan {{ $end_date }}</td>
                    @endif
                </tr>
            @endforeach
        </table>

        <div class="signature">
            <div class="table-signature">
                <table width="100%" style="text-align: center">
                    <tr>
                        <td>Kepala SMK Angkasa 1 Margahayu</td>
                    </tr>
                    <tr>
                        <td style="height: 80px">
                        </td>
                    </tr>
                    <tr>
                        <td>Sutrisno, S.Pd., M.M.Pd. </td>
                    </tr>
                </table>
            </div>
           </div>

       </div>

       {{-- PAGE 3 --}}
       <div style="page-break-before: always">
        <p style="margin: 0; padding: 0; margin-top: 30px; text-align:center; font-size: 20px"><b>SURAT KETERANGAN DITERIMA</b></p>
        <p class="text-justy">Berdasarkan surat permohonan PKL Nomor : 421.5/SMK-A1/700-1/.......-CADISDIKWIL VIII Maka dengan ini kami <b> Bersedia / Tidak Bersedia </b> untuk menerima Siswa :</p>
        <table border="1" class="table-siswa" style="border-collapse:collapse">
            <tr>
                <th style="border: 1px solid black">No.</th>
                <th style="border: 1px solid black">Nama</th>
                <th style="border: 1px solid black">No. Induk Siswa</th>
                <th style="border: 1px solid black">Program Studi</th>
                <th style="border: 1px solid black">Keterangan</th>
            </tr>
            @foreach($data_surat->anggota as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: left">{{ $item->nama }} P</td>
                <td>{{ $item->nis }}</td>
                @if ($loop->iteration === 1)
                <td rowspan="{{ count($data_surat->anggota) }}" style="vertical-align: middle">{{ $data_surat->jurusan->nama }}</td>
                <td rowspan="{{ count($data_surat->anggota) }}" style="vertical-align: middle">{{ $start_date }} sampai dengan {{ $end_date }}</td>
                @endif
            </tr>
        @endforeach
        </table>
        <p class="mt-5 text-justy">Untuk melaksanakan PKL (Praktik Kerja Lapangan) di <b>{{ $data_surat->perusahaan }}</b> mulai tanggal <b>{{ $start_date }} sampai dengan {{ $end_date }} </b></p>
        <p class="text-justy">Demikian surat pemberitahuan ini kami sampaikan untuk dipergunakan sebagaimana mestinya.</p>
        <div class="signature">
        <div class="table-signature">
        <table width="100%" style="text-align: center; margin-top: 130px">
            <tr>
                <td>................, .........................2024</td>
            </tr>
            <tr>
                <td>Pimpinan Perusahaan</td>
            </tr>
            <tr>
                <td style="height: 80px">
                </td>
            </tr>
            <tr>
                <td>..............................................</td>
            </tr>
        </table>
        </div>
        </div>
       </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
