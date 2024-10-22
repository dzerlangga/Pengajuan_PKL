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

    <div class="text-center w-100">
        <div class="logo mt-6">
            <img src="{{ asset('assets/img/logos/yayasan.png') }}" height="98.86" class="mx-2" />
            <img src="{{ asset('assets/img/logos/angkasa.png') }}" height="98.86" class="mx-2" />
        </div>
        <div>
            <form class="my-4 rounded" style="background-color: rgba(237, 237, 237, 0.9); color:rgb(68, 68, 68)" id="regForm" action="/action_page.php">
                <div style="text-align:center;margin-bottom:25px;">
                    <span class="step finish align-content-center">1</span>
                    <span class="step align-content-center">2</span>
                    <span class="step align-content-center">3</span>
                  </div>
                <!-- One "tab" for each step in the form: -->
                <div class="tab">
                  <div class="text-start">
                    <p>Halo <span><b>Siswa/i</b></span> SMK,</p>
                    <p>Untuk melengkapi proses pengajuan Praktik Kerja Lapangan (PKL), kami membutuhkan informasi mengenai jurusan yang saat ini kamu pilih di sekolah. Informasi ini akan membantu kami dalam menempatkan kamu di perusahaan yang sesuai dengan bidang keahlianmu.</p>
                  </div>
                  Pilih Jurusan:
                  <div class="col-4 m-auto">
                    <select id="selectJurusan" class="form-select">
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
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="body_table">
                                        <tr id="empty-data"><td class="dataTables-empty" colspan="3">Belum ada anggota yang ditambah</td></tr>
                                        {{-- <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">Deni RM</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">16102411186</p>
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
                                        <tr>
                                            <td class="ps-4">
                                                <p class="text-xs font-weight-bold mb-0">Dandi ZE</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">16102411187</p>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                <span>
                                                    <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                </span>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  {{-- <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p> --}}
                  {{-- <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p> --}}
                </div>
                <div class="tab">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputPassword">
                        </div>
                      </div>
                    {{-- Nama Perusahaan: --}}
                  {{-- <p><input placeholder="dd" oninput="this.className = ''" name="dd"></p>
                  <p><input placeholder="mm" oninput="this.className = ''" name="nn"></p>
                  <p><input placeholder="yyyy" oninput="this.className = ''" name="yyyy"></p> --}}
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-info btn-sm ms-2" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" class="btn bg-gradient-secondary btn-siswa-disable btn-sm ms-2" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
                <!-- Circles which indicates the steps of the form: -->

              </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    var currentTab = 2; // Current tab is set to be the first tab (0)
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
            alert('nis telah tambahkan')
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
        if (data_anggota.length < 6 ) button('add')
        if (data_anggota.length === 0 ) {
            $('#empty-data').show()
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
            }else{
                $('#tambah_button').removeClass('bg-gradient-secondary btn-siswa-disable')
                $('#tambah_button').addClass('bg-gradient-success')
            }
        }else{
            return
        }
    }

    function renderTable(table = null) {
            $('#empty-data').hide()

            body_table.append(`
            <tr>
                <td class="ps-4">
                    <p class="text-xs font-weight-bold mb-0">${table.nama}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">${table.nis}</p>
                </td>
                <td class="text-center">
                    <span class="del-anggota" id="${table.nis}">
                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                    </span>
                </td>
            </tr>
            `)

            if (data_anggota.length === 6) {
                button('add','disable')
            }
    }

    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        button('next','success')
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        if (data_anggota.length === 0 && n == 1) {
           button('next','disable')
        }else if (id_jurusan) {
            button('next')
        }
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
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
