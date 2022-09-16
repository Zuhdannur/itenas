@extends('layouts/contentLayoutMaster')

@section('title', 'Kelola Pengguna')

@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-12">
            @if (empty($data))
                {{ Form::open(['route' => 'inovasi.store', 'class' => 'form form-vertical', 'id' => 'defaultForm']) }}
            @else
                {{ Form::model($data, ['route' => ['inovasi.update', $data->id]]) }}
                <input type="text" value="PUT" name="_method" hidden>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Inovasi</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            {{ Form::customText('name', 'Nomor', '', ['placeholder' => 'Masukkan Nomor', 'disabled' => true]) }}
                        </div>
                        <div class="col-4">
                            {{ Form::customSelect('jenis_id', $jenis, 'Jenis Inovasi', '', ['placeholder' => '', 'class' => 'select2', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-8">
                            {{ Form::customText('judul', 'Judul Inovasi', '', ['placeholder' => 'Masukkan Judul Inovasi', 'disabled' => @$disabled ?? false]) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengagas / Peneliti / penulis</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            {{ Form::customText('nama', 'Nama', '', ['placeholder' => 'Masukkan Nama', 'disabled' => $disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customText('nik_nim', 'Nik / Nim', '', ['placeholder' => 'Masukkan Nik / Nama', 'disabled' => $disabled ?? false]) }}
                        </div>
                        <div class="col-12">
                            {{ Form::customSelect('status_penulis', ['Dosen Tetap' => 'Dosen Tetap', 'Dosen' => 'Dosen', 'Terbang' => 'Terbang', 'Mahasiswa' => 'Mahasiswa', 'Lain Lain' => 'Lain Lain'], 'Status Penulis', '', ['placeholder' => '', 'class' => 'select2', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customText('prodi', 'Prodi', '', ['placeholder' => 'Masukkan Prodi', 'disabled' => $disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customText('fakultas', 'Fakultas', '', ['placeholder' => 'Masukkan Fakultas', 'disabled' => $disabled ?? false]) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Inovasi Di Itenas</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            {{ Form::customDate('pendaftaran_inovasi', 'Pendaftaran Inovasi', '', ['placeholder' => 'Masukkan Tanggal Pendaftaran Inovasi', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customDate('selesai_inovasi', 'Selesai Inovasi', '', ['placeholder' => 'Masukkan Tanggal Selesai Inovasi', 'disabled' => @$disabled ?? false]) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Status Haki</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            {{ Form::customDate('pendaftaran_haki', 'Pendaftaran Haki', '', ['placeholder' => 'Masukkan Tanggal Pendaftaran Haki', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customDate('selesai_haki', 'Selesai Haki', '', ['placeholder' => 'Masukkan Tanggal Selesai Haki', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customText('startup_tekno', 'Startup Tekno', '', ['placeholder' => 'Masukkan Startup Tekno', 'disabled' => $disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customText('perush_spinoff', 'Perush Spinoff', '', ['placeholder' => 'Masukkan Perush Spinoff', 'disabled' => $disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customSelect('income_inovasi', ['ada income' => 'ada income', 'belum ada income' => 'belum ada income'], 'Jenis Inovasi', '', ['placeholder' => '', 'class' => 'select2', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customSelect('status_implementasi', ['Terimplementasi' => 'Terimplementasi', 'Belum Terimplementasi' => 'Belum Terimplementasi'], 'Jenis Inovasi', '', ['placeholder' => '', 'class' => 'select2', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customText('dampak_sosial', 'Dampak Sosial', '', ['placeholder' => 'Masukkan Dampak Sosial', 'disabled' => $disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customText('produk_hasil', 'Produk Hasil', '', ['placeholder' => 'Masukkan Produk Hasil', 'disabled' => $disabled ?? false]) }}
                        </div>
                        <div class="col-12">
                            {{ Form::customSelect('mitra_id', $mitra, 'Mitra', '', ['placeholder' => '', 'class' => 'select2', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-12">
                            {{ Form::submit('Simpan', ['class' => 'btn btn-primary mr-1']) }}
                        </div>
                    </div>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>

    <script>
        $(document).ready(function() {

            var jqForm = $('#defaultForm'),
                basicPickr = $('.flatpickr-basic'),
                kontrak = $(".kontrak"),
                mutasi = $(".mutasi"),
                history = $(".history"),
                dtMutasi,
                dtKontrak,
                dtHistory

            select = $('.select2');
            basicPickr.flatpickr();

            // select2
            $("[name='jenis_id']").select2({
                    placeholder: 'Pilih Jenis Inovasi',
                    dropdownParent: $("[name='jenis_id']").parent()
                })
                .change(function() {
                    $(this).valid();
                });

            $("[name='status_penulis']").select2({
                    placeholder: 'Pilih Status Penulis',
                    dropdownParent: $("[name='status_penulis']").parent()
                })
                .change(function() {
                    $(this).valid();
                });


            $("[name='status_implementasi']").select2({
                    placeholder: 'Pilih Status Implementasi',
                    dropdownParent: $("[name='status_implementasi']").parent()
                })
                .change(function() {
                    $(this).valid();
                });


            $("[name='income_inovasi']").select2({
                    placeholder: 'Pilih income Inovasi',
                    dropdownParent: $("[name='income_inovasi']").parent()
                })
                .change(function() {
                    $(this).valid();
                });


            $("[name='mitra_id']").select2({
                    placeholder: 'Pilih Mitra',
                    dropdownParent: $("[name='mitra_id']").parent()
                })
                .change(function() {
                    $(this).valid();
                });



            $("[name='agama']").select2({
                    placeholder: 'Agama',
                    dropdownParent: $("[name='agama']").parent()
                })
                .change(function() {
                    $(this).valid();
                });

            $("[name='status_pernikahan']").select2({
                    placeholder: 'Status Pernikahan',
                    dropdownParent: $("[name='status_pernikahan']").parent()
                })
                .change(function() {
                    $(this).valid();
                });

            $("[name='golongan_darah']").select2({
                    placeholder: 'Golongan darah',
                    dropdownParent: $("[name='golongan_darah']").parent()
                })
                .change(function() {
                    $(this).valid();
                });

            jqForm.validate({
                rules: {
                    'name': {
                        required: true
                    },
                    'username': {
                        required: true
                    },
                    'password': {
                        required: true
                    },
                    'role_id': {
                        required: true
                    },
                }
            });
        })
    </script>
@endsection
