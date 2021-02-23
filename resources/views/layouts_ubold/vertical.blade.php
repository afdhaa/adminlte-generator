<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts_ubold.shared/title-meta', ['title' => $title])
    @include('layouts_ubold.shared/head-css')
    {{-- @include('layouts.shared/head-css', ["demo" => "modern"]) --}}
</head>

<body @yield('body-extra')>
    <!-- Begin page -->
    <div id="wrapper">
        @include('layouts_ubold.shared/topbar')

        @include('layouts_ubold.shared/left-sidebar')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                @yield('content')
            </div>
            <!-- content -->

            @include('layouts_ubold.shared/footer')

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    @include('layouts_ubold.shared/right-sidebar')

    @include('layouts_ubold.shared/footer-script')

</body>

</html>
