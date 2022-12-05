@extends('layouts/contentLayoutMaster')

@section('title', 'Pengaturan')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel='stylesheet' href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    @php
        $appIcon = \App\AppConfig::first();
    @endphp
    <!-- account setting page -->
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column nav-left">
                    <!-- general -->
                    <li class="nav-item">
                        <a class="nav-link active" id="account-pill-general" data-toggle="pill"
                            href="#account-vertical-general" aria-expanded="true">
                            <i data-feather="user" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">General</span>
                        </a>
                    </li>
                    @if (Auth()->user()->role->name == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" id="account-pill-app" data-toggle="pill" href="#account-vertical-app"
                                aria-expanded="true">
                                <i data-feather="hard-drive" class="font-medium-3 mr-1"></i>
                                <span class="font-weight-bold">App</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <!--/ left menu section -->

            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                aria-labelledby="account-pill-general" aria-expanded="true">
                                <!-- header media -->
                                <div class="media">
                                    <a href="javascript:void(0);" class="mr-25">
                                        <img src="{{ Auth::user()->avatar == null ? asset('images/portrait/small/avatar-s-11.jpg') : asset('storage/' . Auth::user()->avatar) }}"
                                            id="account-upload-img" class="rounded mr-50" alt="profile image" height="80"
                                            width="80" />
                                    </a>
                                    <!-- upload and reset button -->
                                    <div class="media-body mt-75 ml-1">
                                        <label for="account-upload"
                                            class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                                        <input type="file" id="account-upload" hidden accept="image/*" />
                                        <p>Allowed JPG or PNG. Max size of 2 MB</p>
                                    </div>
                                    <!--/ upload and reset button -->
                                </div>
                                <!--/ header media -->

                                <!-- form -->
                                <form action="{{ route('settings.update', $user->id) }}" class="mt-2" method="POST">
                                    <input type="text" name="_method" value="PUT" hidden>
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-username">Username</label>
                                                <input type="text" class="form-control" id="account-username"
                                                    name="username" placeholder="Username" value="{{ $user->username }}" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-name">Name</label>
                                                <input type="text" class="form-control" id="account-name" name="name"
                                                    placeholder="Name" value="{{ $user->name }}" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                            @if (Auth()->user()->role->name == 'admin')
                                <div role="tabpanel" class="tab-pane" id="account-vertical-app"
                                    aria-labelledby="account-pill-app" aria-expanded="true">
                                    <!-- header media -->
                                    <div class="media">
                                        <a href="javascript:void(0);" class="mr-25">
                                            <img src="{{ $appIcon == null ? asset('images/portrait/small/avatar-s-11.jpg') : asset('storage/' . $appIcon->filename) }}"
                                                id="account-upload-img" class="rounded mr-50" alt="profile image"
                                                height="80" width="80" />
                                        </a>
                                        <!-- upload and reset button -->
                                        <div class="media-body mt-75 ml-1">
                                            <label for="icon_app" class="btn btn-sm btn-primary mb-75 mr-75">Ubah
                                                Ikon
                                                Aplikasi</label>
                                            <input type="file" id="icon_app" hidden accept="image/*" />
                                            <p>Mengganti Ikon Aplikasi</p>
                                        </div>
                                        <!--/ upload and reset button -->
                                    </div>
                                    <!--/ header media -->
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--/ right content section -->
        </div>
    </section>
    <!-- / account setting page -->
@endsection

@section('vendor-script')
    <!-- vendor files -->
    {{-- select2 min js --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    {{--  jQuery Validation JS --}}
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/page-account-settings.js')) }}"></script>
    <script>
        $(document).ready(function() {
            $("#account-upload").on('change', function(e) {
                var fileData = $('#account-upload').prop('files')[0];
                var formData = new FormData();

                formData.append('file', fileData);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('settings.photo') }}',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    type: 'post',
                    success: function(response) {},
                }).done(function() {
                    location.reload();
                })
            })
            $("#icon_app").on("change", function(e) {

                var fileData = $('#icon_app').prop('files')[0];

                var formData = new FormData();

                formData.append('file', fileData);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('settings.app') }}',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    type: 'post',
                    success: function(response) {},
                }).done(function() {
                    location.reload();
                })
            })
        })
    </script>
@endsection
