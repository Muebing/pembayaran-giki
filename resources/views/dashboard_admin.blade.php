@extends('layout_admin.master')
@section('content')
    <!-- Card Profile Siswa -->
    <div class="row">
        <!-- Card Profile Siswa -->
        <div class="col-xl-6 col-sm-12 mb-4">
            <div class="card card-profile z-index-2 mb-2"
                style="max-height: 200px; overflow: auto; width: 350px; margin-top: 20px;">
                <div class="card-body pt-3 p-2 d-flex align-items-center">
                    <!-- Foto -->
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto User" class="rounded-circle me-3 border"
                        style="width: 80px; height: 80px; object-fit: cover;">
                    <!-- Info -->
                    <div>
                        <h6 class="mb-1">{{ Auth::user()->name }}</h6>
                        <p class="text-muted mb-1">
                            Status: <span class="badge bg-success">{{ Auth::user()->role }}</span>
                        </p>
                        <p class="small mb-0">
                            <i class="ni ni-email-83 me-1"></i>{{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-4 text-uppercase font-weight-bold">Data Siswa</p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="{{ route('siswas.index') }}" style="text-decoration: none;">
                                        <div
                                            class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                            <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Jenis Pembayaran</p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="{{ route('jenis-pembayaran.index') }}" style="text-decoration: none;">
                                        <div
                                            class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                            <i class="ni ni-mobile-button text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Verifikasi Pembayaran</p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="{{ route('verif.pembayaran.index') }}" style="text-decoration: none;">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                            <i class="ni ni-lock-circle-open text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Laporan</p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="{{ route('laporan.pembayaran.index') }}" style="text-decoration: none;">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <i class="ni ni-chart-pie-35 text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-7 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Data Siswa</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <tbody>
                                    @foreach ($siswa as $data)
                                        <tr>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <p class="text-xs font-weight-bold mb-0">Nama:</p>
                                                        <h6 class="text-sm mb-0">{{ $data->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">NISN:</p>
                                                    <h6 class="text-sm mb-0">{{ $data->nisn }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Kelas:</p>
                                                    <h6 class="text-sm mb-0">{{ $data->kelas }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <div class="col text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Jenis Kelamin:</p>
                                                    <h6 class="text-sm mb-0">{{ $data->jenis_kelamin }}</h6>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Verifikasi Pembayaran</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @if ($daftar->isEmpty())
                                    <li class="list-group-item text-center">
                                        Tidak ada data pembayaran yang ditemukan.
                                    </li>
                                @else
                                    @foreach ($daftar as $pembayaran)
                                        <li
                                            class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                    <i class="ni ni-circle-08 text-white opacity-10"></i>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">{{ $pembayaran['nama_siswa'] }}
                                                    </h6>
                                                    <span class="text-xs">Jenis Pembayaran:
                                                        <span
                                                            class="font-weight-bold">{{ $pembayaran['jenis_pembayaran'] }}</span>
                                                    </span><br>
                                                    <span class="text-xs">Nominal:
                                                        <span class="font-weight-bold">Rp
                                                            {{ number_format($pembayaran['nominal'], 0, ',', '.') }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
            <!-- BEGIN MODAL -->
            <div class="modal none-border" id="my-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Add Event</strong></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-success save-event waves-effect waves-light">
                                Create event
                            </button>
                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                data-dismiss="modal">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Add Category -->
            <div class="modal fade none-border" id="add-new-event">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Add</strong> a category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Category Name</label>
                                        <input class="form-control form-white" placeholder="Enter name" type="text"
                                            name="category-name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Choose Category Color</label>
                                        <select class="form-select shadow-none form-white"
                                            data-placeholder="Choose a color..." name="category-color">
                                            <option value="success">Success</option>
                                            <option value="danger">Danger</option>
                                            <option value="info">Info</option>
                                            <option value="primary">Primary</option>
                                            <option value="warning">Warning</option>
                                            <option value="inverse">Inverse</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                class="
                  btn btn-danger
                  waves-effect waves-light
                  save-category
                "
                                data-dismiss="modal">
                                Save
                            </button>
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL -->

            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
@endsection
