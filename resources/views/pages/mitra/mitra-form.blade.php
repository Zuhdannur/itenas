@extends('layouts/contentLayoutMaster')

@section('title', 'Kelola Mitra')

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
                {{ Form::open(['route' => 'mitra.store', 'class' => 'form form-vertical', 'id' => 'defaultForm']) }}
            @else
                {{ Form::model($data, ['route' => ['mitra.update', $data->id]]) }}
                <input type="text" value="PUT" name="_method" hidden>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Pengguna</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            {{ Form::customText('industri', 'industri', '', ['placeholder' => 'Masukkan industri', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customSelect('jenis', ['Pemerintahan' => 'Pemerintahan', 'Swasta' => 'Swasta'], 'Jenis', '', ['placeholder' => '', 'class' => 'select2', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customSelect('national_international', ['Nasioanl' => 'Nasioanl', 'Internasional' => 'Internasional'], 'National / International', '', ['placeholder' => '', 'class' => 'select2', 'disabled' => @$disabled ?? false]) }}
                        </div>
                        <div class="col-6">
                            {{ Form::customText('sumber_pendanaan', 'Sumber Pendanaan', '', ['placeholder' => 'Sumber Pendanaan', 'disabled' => @$disabled ?? false]) }}
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
            $("[name='national_international']").select2({
                    placeholder: 'Pilih',
                    dropdownParent: $("[name='national_international']").parent()
                })
                .change(function() {
                    $(this).valid();
                });



            $("[name='jenis']").select2({
                    placeholder: 'Pilih',
                    dropdownParent: $("[name='jenis']").parent()
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
