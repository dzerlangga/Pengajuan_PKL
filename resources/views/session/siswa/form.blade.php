@extends('layouts.user_type.guest')

@section('content')
<style>
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #f1f1f1;
    }

    #regForm {
      background-color: #ffffff;
      margin: 100px auto;
      font-family: Raleway;
      padding: 40px;
      width: 70%;
      min-width: 300px;
    }

    h1 {
      text-align: center;
    }

    input {
      padding: 10px;
      width: 100%;
      font-size: 17px;
      font-family: Raleway;
      border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
      display: none;
    }

    button {
      background-color: #04AA6D;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      font-size: 17px;
      font-family: Raleway;
      cursor: pointer;
    }

    button:hover {
      opacity: 0.8;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
      height: 40px;
      width: 40px;
      margin: 0 10px;
      background-color: #bbbbbb;
      border: none;
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }

    .step.active {
      opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #FEAB06;
      color: white
    }
    </style>
<div class="container-siswa">
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
                <div class="tab">Nama Anggota:
                  <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
                  <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p>
                </div>
                <div class="tab">Nama Perusahaan:
                  <p><input placeholder="dd" oninput="this.className = ''" name="dd"></p>
                  <p><input placeholder="mm" oninput="this.className = ''" name="nn"></p>
                  <p><input placeholder="yyyy" oninput="this.className = ''" name="yyyy"></p>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-siswa btn-danger-siswa text-white fw-bold ms-1" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" class="btn-siswa btn-siswa-disable btn-secondary-siswa text-white fw-bold ms-1" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
                <!-- Circles which indicates the steps of the form: -->

              </form>
        </div>
    </div>
</div>

<script>
    let id_select_jurusan = document.getElementById('selectJurusan')
    let btnNext = document.getElementById('nextBtn')
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    !localStorage.getItem("Read") && window.history.back() ;

    id_select_jurusan.addEventListener("change", function() {
        if (this.value === "0") {
            btnNext.classList.add('btn-secondary-siswa');
            btnNext.classList.add('btn-siswa-disable');
            btnNext.classList.remove('btn-primary-siswa');
        }else{
            setTimeout(() => {
                btnNext.classList.remove('btn-secondary-siswa');
                btnNext.classList.remove('btn-siswa-disable');
                btnNext.classList.add('btn-primary-siswa');
            }, 200);
        }
    });

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
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
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
      console.log(currentTab);

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
