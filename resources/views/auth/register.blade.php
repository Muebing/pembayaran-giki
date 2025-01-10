<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/Logo_SMK.png">
    <title>Form Register SMA GITA KIRTI 2 Jakarta</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
    <!-- Add SweetAlert2 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="">
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('{{ asset('assets/img/bg-sekolah.jpg') }}'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
                        <p class="text-lead text-white">SMA GITA KIRTI 2 Jakarta</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Register</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Nama lengkap"
                                        aria-label="Name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="nisn" class="form-control" placeholder="NISN"
                                        aria-label="NISN" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat"
                                        aria-label="Alamat" required>
                                </div>
                                <div class="mb-3">
                                    <select name="kelas" id="kelas" class="form-control" required>
                                        <option value="pilih_kelas">Pilih Kelas</option>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII IPA">XII IPA</option>
                                        <option value="XII IPS">XII IPS</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="agama" class="form-control" placeholder="Agama"
                                        aria-label="Agama" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="tempat_lahir" class="form-control"
                                        placeholder="Tempat Lahir" aria-label="Tempat Lahir" required>
                                </div>
                                <div class="mb-3">
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                        placeholder="Tanggal Lahir" aria-label="Tanggal Lahir" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="no_telp" class="form-control" placeholder="No. Telepon"
                                        aria-label="No. Telepon" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        aria-label="Email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Password" aria-label="Password" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Konfirmasi Password" aria-label="Confirm Password" required>
                                </div>
                                <div class="mb-3">
                                    <input type="file" name="foto" class="form-control" aria-label="Foto">
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Sudah punya akun? <a href="{{ route('login') }}"
                                        class="text-dark font-weight-bolder">Masuk</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../assets/js/argon-dashboard.min.js?v=2.1.0"></script>
    <script>
        // Event listener untuk form submit
        document.querySelector("form").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah form untuk submit secara langsung

            // Ambil semua input dalam form
            let name = document.querySelector("input[name='name']").value;
            let nisn = document.querySelector("input[name='nisn']").value;
            let alamat = document.querySelector("input[name='alamat']").value;
            let kelas = document.querySelector("select[name='kelas']").value;
            let jenisKelamin = document.querySelector("select[name='jenis_kelamin']").value;
            let agama = document.querySelector("input[name='agama']").value;
            let tempatLahir = document.querySelector("input[name='tempat_lahir']").value;
            let tanggalLahir = document.querySelector("input[name='tanggal_lahir']").value;
            let noTelp = document.querySelector("input[name='no_telp']").value;
            let email = document.querySelector("input[name='email']").value;
            let password = document.querySelector("input[name='password']").value;
            let passwordConfirmation = document.querySelector("input[name='password_confirmation']").value;

            // Validasi input (contoh)
            if (!name || !nisn || !alamat || kelas === "pilih_kelas" || !jenisKelamin || !agama || !tempatLahir || !
                tanggalLahir || !noTelp || !email || !password || !passwordConfirmation) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Semua field harus diisi dengan benar!',
                    confirmButtonText: 'Tutup'
                });
                return;
            }

            // Validasi Email
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Email Tidak Valid',
                    text: 'Mohon masukkan email yang valid.',
                    confirmButtonText: 'Tutup'
                });
                return;
            }

            // Validasi No Telepon
            const telpPattern = /^[0-9]{10,12}$/;
            if (!telpPattern.test(noTelp)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Nomor Telepon Tidak Valid',
                    text: 'Nomor telepon harus terdiri dari 10-12 digit angka.',
                    confirmButtonText: 'Tutup'
                });
                return;
            }

            // Cek apakah password dan konfirmasi password sama
            if (password !== passwordConfirmation) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password dan Konfirmasi Password tidak cocok!',
                    confirmButtonText: 'Tutup'
                });
                return;
            }

            // Validasi panjang password
            if (password.length < 6) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Terlalu Pendek',
                    text: 'Password harus terdiri dari minimal 6 karakter.',
                    confirmButtonText: 'Tutup'
                });
                return;
            }

            // Validasi Tanggal Lahir (cek usia minimal 13 tahun)
            const today = new Date();
            const birthDate = new Date(tanggalLahir);
            const age = today.getFullYear() - birthDate.getFullYear();
            if (age < 13) {
                Swal.fire({
                    icon: 'error',
                    title: 'Usia Terlalu Muda',
                    text: 'Usia minimal adalah 13 tahun.',
                    confirmButtonText: 'Tutup'
                });
                return;
            }

            // Jika semua validasi lolos, kirimkan form
            this.submit(); // Form akan disubmit setelah validasi berhasil
        });
    </script>


</body>

</html>
