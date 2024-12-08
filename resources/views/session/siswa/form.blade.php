@extends('layouts.user_type.guest')

@section('content')
<div class="container-siswa rounded">

    {{-- MODAL --}}
    <div class="modal fade" id="anggotaModal" aria-hidden="true" aria-labelledby="anggotaModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="anggotaModalLabel">Tambah Anggota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="formAnggota">
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control input-anggota" id="nama" aria-describedby="namaHelp">
                      <div id="namaHelp" class="form-text">Pastikan nama sudah benar</div>
                    </div>
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" name="nis" class="form-control input-anggota" id="nis" aria-describedby="nisHelp">
                        <div id="nisHelp" class="form-text">Pastikan NIS sudah benar</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-success">Simpan</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    {{-- END MODAL --}}

    <div class="w-100">
        <div class="logo mt-6 text-center">
            <img src="{{ asset('assets/img/logos/yayasan.png') }}" height="98.86" class="mx-2" />
            <img src="{{ asset('assets/img/logos/angkasa.png') }}" height="98.86" class="mx-2" />
        </div>
        <div>
            <form action="{{ route('pengajuan.store') }}" method="POST" class="my-4 rounded" style="background-color: rgba(237, 237, 237, 0.9); color:rgb(68, 68, 68)" id="regForm">
                @csrf
                <input type="text" value="{{ $id_program ?? '' }}" class="form-control" id="program" hidden name="program">

                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-bottom:25px;">
                    <span class="step finish align-content-center">1</span>
                    <span class="step align-content-center">2</span>
                    <span class="step align-content-center">3</span>
                    <span class="step align-content-center">4</span>
                </div>
                <!-- One "tab" for each step in the form: -->
                <div class="tab text-center">
                  <div class="text-start">
                    <p>Halo <span><b>Siswa/i</b></span> SMK,</p>
                    <p class="p-menjorok">Untuk melengkapi proses pengajuan Praktik Kerja Lapangan (PKL), kami membutuhkan informasi mengenai jurusan yang saat ini kamu pilih di sekolah. Informasi ini akan membantu kami dalam menempatkan kamu di perusahaan yang sesuai dengan bidang keahlianmu.</p>
                  </div>
                  Pilih Jurusan:
                  <div class="col-4 m-auto">
                    <select id="selectJurusan" name="jurusan" class="form-select">
                    <option selected value="0">Pilih Jurusan...</option>
                        @foreach ($jurusan as $data)
                            <option value="{{$data->id}}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="tab">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div class="text-start">
                                    <h6 class="mb-0">ANGGOTA PRAKTIK KERJA LAPANGAN</h6>
                                </div>
                                <a href="#" id="tambah_button" class="btn bg-gradient-success btn-sm mb-0" type="button" data-bs-target="#anggotaModal" data-bs-toggle="modal">+&nbsp; Tambah Anggota</a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <div class="w-100 text-start px-4">
                                    <span class="text-danger text-start" style="font-size: 10px">*MAX ANGGOTA ADALAH 6 ORANG</span>
                                </div>
                                <table class="table align-items-center mb-0" id="table-anggota">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NAMA
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                NIS
                                            </th>
                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="body_table">
                                        <tr id="empty-data" class="text-center"><td class="dataTables-empty" colspan="3">Belum ada anggota yang ditambah</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab">
                    <div class="text-start">
                        <p class="p-menjorok">Sebagai bagian dari proses pengajuan Praktik Kerja Lapangan (PKL), kamu perlu mengisi Form Pengisian Perusahaan. Informasi ini sangat penting untuk memudahkan kami dalam menempatkan kamu di perusahaan yang sesuai dengan pilihan dan minatmu.</p>
                        <p><span><b>Penting:</b></span> Pengisian form ini wajib dilakukan sebagai bagian dari kelengkapan administrasi PKL. Pastikan data yang kamu berikan akurat dan sesuai dengan perusahaan yang sudah atau akan kamu hubungi.</p>
                    </div>
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan (Harus Lengkap) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="perusahaan">
                        <span class="info">(contoh : PT Baraya Telematika, contoh : Bengkel Rahmat Putra )</span>
                    </div>
                    <div class="form-group">
                        <label for="alamat_perusahaan">Alamat Perusahaan (Harus Lengkap) <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
                        <span class="info">(contoh : Jl. Sukasari no 12/78 Kel Gaga Kec Cijawura Kota Bandung)</span>
                    </div>
                </div>
                <div class="tab">
                    <p class="p-menjorok">kami membutuhkan nomor WhatsApp yang bisa dihubungi. Harap segera mengisi Form Nomor WA agar kami dapat memastikan semua informasi penting tersampaikan dengan lancar.</p>
                    <div class="form-group">
                        <label for="no_hp">No Telepon (WA) <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="08*********" required>
                    </div>
                    <p><span><b>Penting:</b></span> Mohon di ingat yah Form ini hanya bisa di isi <b> 1 Akun 1 Kali </b>Tidak ada perubahan dalam pembentukan apa pun terkecuali alasan yang mendukung ... Terimakasih!!!</p>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ url('pengajuanpkl') }}" id="backBtn"><button type="button" class="btn bg-gradient-info btn-sm ms-2" id="backBtn">Kembali</button></a>
                    <button type="button" class="btn bg-gradient-info btn-sm ms-2" id="prevBtn" onclick="nextPrev(-1)">Sebelumnya</button>
                    <button type="button" class="btn bg-gradient-secondary btn-siswa-disable btn-sm ms-2" id="nextBtn" onclick="nextPrev(1)">Selanjutnya</button>
                </div>

              </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let id_select_jurusan = $('#selectJurusan');
    let anggotaModal = $('#anggotaModal');
    let form_anggota = $('#formAnggota');
    let body_table = $('#body_table');
    let table_anggota = $('#table-anggota');
    let btnNext = document.getElementById('nextBtn');
    let inputs = document.querySelectorAll('.input-anggota');
    let id_jurusan = null
    let data_anggota = []
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    !localStorage.getItem("Read") && window.history.back() ;

    anggotaModal.on('hidden.bs.modal', function () {
        inputs.forEach(function(input) {
          input.value = ''; // Mengosongkan nilai elemen
        });
    })

    form_anggota.on('submit', function (event) {
        event.preventDefault();
        let data = {
            nama: '',
            nis: ''
        }
        inputs.forEach(function(input) {
            data[input.name] = input.value
        });

        if (data.nama === '' || data.nis === '') {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Data belum di masukan',
                    icon: 'warning',
                    confirmButtonText: 'Tutup'
                    })
                return
            }

        if (data_anggota.find(e=> e.nis === data.nis)) {
            Swal.fire({
                    title: 'Peringatan!',
                    text: 'NIS telah ada!',
                    icon: 'warning',
                    confirmButtonText: 'Tutup'
                    })
            return
        }
        data_anggota = [...data_anggota, data]
        button('next')
        anggotaModal.modal('hide')
        renderTable(data)
    })

    id_select_jurusan.on("change", function() {
        id_jurusan = this.value
        if (this.value === "0") {
            button('next','disable')
        }else{
            button('next')
        }
    });

    // FUNTION DELETE ANGGOTA BY ROW
    table_anggota.on('click', '.del-anggota', function() {
        let nis = $(this).attr('id')
        let filter = data_anggota.filter(e=> e.nis !== nis)
        data_anggota = filter
        var rowIndex = $(this).closest('tr').index();
        $('#table-anggota tbody tr').eq(rowIndex).remove();
        if (data_anggota.length < 6 ) button('add','show')
        if (data_anggota.length === 0 ) {
            body_table.html('<tr class="text-center"><td class="dataTables-empty" colspan="3">Belum ada anggota yang ditambah</td></tr>')
            button('next', 'disable')
        }
    });

    function button(type,condition) {
        if (type?.includes('next')) {
            if (condition?.includes('disable')) {
                btnNext.classList.add('bg-gradient-secondary');
                btnNext.classList.add('btn-siswa-disable');
                btnNext.classList.remove('bg-gradient-info');
                btnNext.classList.remove('bg-gradient-success');
            }else if (condition?.includes('success')) {
                btnNext.classList.remove('bg-gradient-info');
                btnNext.classList.add('bg-gradient-success');
            }else{
                btnNext.classList.remove('bg-gradient-secondary');
                btnNext.classList.remove('btn-siswa-disable');
                btnNext.classList.add('bg-gradient-info');
            }
        }else if (type?.includes('add')) {
            if (condition?.includes('disable')) {
                $('#tambah_button').addClass('bg-gradient-secondary btn-siswa-disable')
                $('#tambah_button').removeClass('bg-gradient-success')
            }else if(condition.includes('hide')){
                $('#tambah_button').hide()
            }else if(condition.includes('show')){
                $('#tambah_button').show()
            }else{
                $('#tambah_button').removeClass('bg-gradient-secondary btn-siswa-disable')
                $('#tambah_button').addClass('bg-gradient-success')
            }
        }else{
            return
        }
    }

    function renderTable(table = null) {
            let html = ''
            data_anggota.map((e,index)=>{
                html +=`
                <tr>
                    <td class="ps-4">
                        <p class="text-xs font-weight-bold mb-0">${e.nama}</p>
                        <input type="hidden" name="anggota[${index}][nama]" value="${e.nama}" />
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${e.nis}</p>
                        <input type="hidden" name="anggota[${index}][nis]" value="${e.nis}" />
                    </td>
                    <td class="text-center">
                        <span class="del-anggota" id="${e.nis}">
                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                        </span>
                    </td>
                </tr>
                `
            })
            body_table.html(html)

            if (data_anggota.length === 6) {
                button('add','hide')
            }
    }

    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("backBtn").style.display = "inline";
        } else {
            document.getElementById("backBtn").style.display = "none";
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
              button('next','success')
              btnNext.innerHTML = "Submit";
            //   btnNext.setAttribute('type','submit')
        } else {
            // btnNext.removeAttribute('type')
            if (data_anggota.length === 0 && n == 1) {
                button('next','disable')
            }else if (id_jurusan) {
                button('next')
            }
            btnNext.innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("tab");
      if (currentTab + n >= x.length) {

        document.getElementById("regForm").submit();
        return false;
      }
      if (n == 1 && !validateForm()) return false;
      x[currentTab].style.display = "none";

      currentTab = currentTab + n;

      showTab(currentTab);
    }

    function validateForm() {

      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab+1].className += " finish";
     }else{
        document.getElementsByClassName("step")[currentTab].classList.remove('finish');
      }

      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }


    </script>
@endsection
