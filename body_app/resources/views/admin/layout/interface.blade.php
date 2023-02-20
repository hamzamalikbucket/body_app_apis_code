
@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')

<!--Begin: Leader -->

<!--End: Leader -->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
                @yield('bread-cumbs')
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

@include('admin.layout.footer')

