@extends('layouts/contentLayoutMaster')

@section('title', 'Kelola User')

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
                }],

                language: {
                    paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            });
        })
    </script>
@endsection
