<body
    class="vertical-layout vertical-menu-modern {{ $configData['showMenu'] === true ? '2-columns' : '1-column' }}
{{ $configData['blankPageClass'] }} {{ $configData['bodyClass'] }}
{{ $configData['verticalMenuNavbarType'] }}
{{ $configData['sidebarClass'] }} {{ $configData['footerType'] }}"
    data-menu="vertical-menu-modern" data-col="{{ $configData['showMenu'] === true ? '2-columns' : '1-column' }}"
    data-layout="{{ $configData['theme'] === 'light' ? '' : $configData['layoutTheme'] }}"
    style="{{ $configData['bodyStyle'] }}" data-framework="laravel" data-asset-path="{{ asset('/') }}">

    {{-- Include Sidebar --}}
    @if (isset($configData['showMenu']) && $configData['showMenu'] === true)
        @include('panels.sidebar')
    @endif

    {{-- Include Navbar --}}
    @include('panels.navbar')

    <!-- BEGIN: Content-->
    <div class="app-content content {{ $configData['pageClass'] }}">
        <!-- BEGIN: Header-->
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>

        @if ($configData['contentLayout'] !== 'default' && isset($configData['contentLayout']))
            <div class="content-area-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container p-0' : '' }}">
                <div class="{{ $configData['sidebarPositionClass'] }}">
                    <div class="sidebar">
                        {{-- Include Sidebar Content --}}
                        @yield('content-sidebar')
                    </div>
                </div>
                <div class="{{ $configData['contentsidebarClass'] }}">
                    <div class="content-wrapper">
                        <div class="content-body">
                            {{-- Include Page Content --}}
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="content-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container p-0' : '' }}">
                {{-- Include Breadcrumb --}}
                @if ($configData['pageHeader'] === true && isset($configData['pageHeader']))
                    @include('panels.breadcrumb')
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ Session::get('success') }}
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                            {{ Session::get('error') }}
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="content-body">
                    {{-- Include Page Content --}}
                    @yield('content')
                </div>
            </div>
        @endif

    </div>
    <!-- End: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    {{-- include footer --}}
    @include('panels/footer')

    {{-- include default scripts --}}
    @include('panels/scripts')

    <script type="text/javascript">
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

        $(document).ready(function() {
            $("body").on("click", ".btnDelete", function(e) {

                e.preventDefault();

                var token = '{{ csrf_token() }}';
                var form = $('<form id="formDelete" method="POST"></form>')

                form.append('<input type="text" name="_method" value="DELETE">');
                form.append('<input type="text" name="_token" value="' + token + '">');
                form.attr('action', $(this).attr('href'))

                $('body').append(form);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ml-1'
                    },
                    buttonsStyling: false,
                    showClass: {
                        popup: 'animate__animated animate__fadeIn'
                    },
                }).then(function(result) {
                    if (result.value) {
                        $("form#formDelete").submit();
                    }
                });
            })
        })
    </script>
</body>

</html>
