@extends('layouts/contentLayoutMaster')

@section('title', 'Data inovasi')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <section id="basic-datatable">
                            <div class="row">
                                <div class="col-12">
                                    <table class="datatables-basic table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul Inovasi</th>
                                                <th>Jenis Inovasi</th>
                                                <th>Nama</th>
                                                <th>Nik/Nim</th>
                                                <th>Dosen Tetap / Dosen Terbang <br>Mahasiswa</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalCenterTitle">Upload File Excel
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" />
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-primary btnLoading" type="button" disabled style="display:none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="ml-25 align-middle">Loading...</span>
                        </button>
                        <button type="button" class="btn btn-primary btnUpload">Upload</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="toast toast-basic hide position-fixed" role="alert" aria-live="assertive" aria-atomic="true"
            data-delay="5000" style="top: 1rem; right: 1rem">
            <div class="toast-header">
                <img src="{{ asset('images/logo/logo.png') }}" class="mr-1" alt="Toast image" height="18"
                    width="25" />
                <strong class="mr-auto">Pemberitahuan</strong>
                <button type="button" class="ml-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">Data berhasil di import</div>
        </div>
    </section>
@endsection

@section('vendor-script')
    {{-- vendor files --}}
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
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
    <script>
        var datatables;
        $(document).ready(function() {
            var table = $('.table'),
                assetPath = '../../../app-assets/';

            if ($('body').attr('data-framework') === 'laravel') {
                assetPath = $('body').attr('data-asset-path');
            }

            datatables = table.DataTable({
                serverSide: true,
                processing: true,
                orderMulti: true,
                stateSave: true,
                ajax: {
                    url: '{!! route('inovasi.getData') !!}',
                    type: 'GET',
                    global: false,
                    data: function(e) {
                        return e;
                    }
                },
                columns: [{
                        data: 'no'
                    },
                    {
                        data: 'judul'
                    },
                    {
                        data: 'jenis.name'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'nik_nim'
                    },
                    {
                        data: 'status_penulis'
                    },
                    {
                        data: ''
                    },
                ],
                columnDefs: [{
                        targets: 0,
                        visible: true
                    },
                    {
                        // Actions
                        targets: -1,
                        title: 'Actions',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return (
                                '<div class="d-inline-flex">' +
                                '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
                                feather.icons['more-vertical'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>' +
                                '<div class="dropdown-menu dropdown-menu-right">' +
                                '<a href="' + full.destroy +
                                '" class="dropdown-item delete-record btnDelete">' +
                                feather.icons['trash-2'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) +
                                'Delete</a>' +
                                '</div>' +
                                '</div>' +
                                '<a href="' + full.edit +
                                '" class="item-edit">' +
                                feather.icons['edit'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>'
                            );
                        }
                    }
                ],
                order: [
                    [2, 'desc']
                ],
                dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: [{
                        text: feather.icons['plus'].toSvg({
                            class: 'mr-50 font-small-4'
                        }) + 'Tambah',
                        className: 'create-new btn btn-primary',
                        attr: {
                            'onclick': 'window.location.href="{{ route('inovasi.create') }}";return false;',

                        },
                        init: function(api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    },
                    {
                        text: feather.icons['file-text'].toSvg({
                            class: 'mr-50 font-small-4'
                        }) + 'Import',
                        className: 'create-new btn btn-success ml-1 btnImport',
                        attr: {},
                        init: function(api, node, config) {}

                    }
                ],

                language: {
                    paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            });

            $(".btnImport").on("click", function() {
                $("#modalImport").modal('show')
            })

            $(".btnUpload").on("click", function() {
                $(".btnLoading").show();
                $(this).hide();

                var fileData = $('#customFile').prop('files')[0];

                var formData = new FormData();

                formData.append('file', fileData);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('inovasi.import') }}',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    type: 'post',
                    success: function(response) {
                        $('.toast-basic').toast('show');
                    },
                }).done(function() {
                    $("#modalImport").modal('hide')
                    $(".btnLoading").hide();
                    $(this).show();

                    datatables.ajax.reload();
                });

            })

        })
    </script>
@endsection
