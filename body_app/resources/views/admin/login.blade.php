<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>Verithrust Validations</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/vendors/css/vendors.min.css')}}">
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/vendors/css/vendors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/vendors/css/charts/chartist.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/vendors/css/charts/chartist-plugin-tooltip.css')}}">
        <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/css/components.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/css/pages/chat-application.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/css/pages/dashboard-analytics.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 1-column  bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="font-large-1  text-center">
                                         Login
                                    </div>
                                </div>
                                <div class="card-content">

                                    <div class="card-body">
                                        @if (session()->has('success') || session()->has('error'))
                                            <div class="alert alert-{{session()->has('success') ? 'success' : 'danger'}}">
                                                {{session()->has('success') ? session()->get('success') : session()->get('error')}}
                                            </div>
                                        @endif
                                        <form class="form-horizontal" action="" method="post" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="email" class="form-control round" name="email" id="user-name" placeholder="Your email" >
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control round" name="password" id="user-password" placeholder="Enter Password" >
                                                <div class="form-control-position">
                                                    <i class="ft-lock"></i>
                                                </div>
                                            </fieldset>
                                            {{-- <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-sm-left">

                                                </div>
                                                <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                                            </div> --}}
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
   <!-- BEGIN: Vendor JS-->
<script src="{{asset('/assets/admin/')}}/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('/assets/admin/')}}/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
<script src="{{asset('/assets/admin/')}}/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('/assets/admin/')}}/js/core/app-menu.js" type="text/javascript"></script>
<script src="{{asset('/assets/admin/')}}/js/core/app.js" type="text/javascript"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('/assets/admin/')}}/js/scripts/pages/dashboard-analytics.js" type="text/javascript"></script>
<!-- END: Page JS-->

<script src="{{asset('/assets/admin/js/custom.js')}}"> </script>
<script>
    $('#myTable').DataTable({

    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    // responsive: true,

    responsive: {
    details: {
        type: 'column'
    }
    },
    columnDefs: [ {
        className: 'dtr-control',
        orderable: false,
        targets:   0
    } ],
    order: [ 1, 'asc' ]
});
</script>

</body>
<!-- END: Body-->

</html>
