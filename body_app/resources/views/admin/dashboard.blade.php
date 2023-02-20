@extends('admin.layout.interface')

@section('bread-cumbs')
    @include('admin.layout.breadcrumbs',
    ['breadcrumbs' =>
        ['title' => 'Dashbaord',
         'items' => [
             ['name' => 'Home', 'url' => url("/"), 'active' => false],
         ]
        ]
    ])
@endsection

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <div class="card pull-up border-top-info border-top-3 rounded-0">
                                <div class="card-header">
                                    <h4 class="card-title">Total App User </h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body p-1">
                                        <h4 class="font-large-1 text-bold-400">{{ $totalAppUsers }}<i class="ft-users float-right"></i></h4>
                                    </div>
                                    <div class="card-footer p-1">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="card pull-up border-top-info border-top-3 rounded-0">
                                <div class="card-header">
                                    <h4 class="card-title">Total ContactUs </h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body p-1">
                                        <h4 class="font-large-1 text-bold-400">{{ $totalContactUs }}<i class="ft-phone-incoming float-right"></i></h4>
                                    </div>
                                    <div class="card-footer p-1">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="card pull-up border-top-info border-top-3 rounded-0">
                                <div class="card-header">
                                    <h4 class="card-title">Total Courses </h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body p-1">
                                        <h4 class="font-large-1 text-bold-400">{{ $totalCourses }}<i class="ft-edit float-right"></i></h4>
                                    </div>
                                    <div class="card-footer p-1">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="card pull-up border-top-info border-top-3 rounded-0">
                                <div class="card-header">
                                    <h4 class="card-title">Total This Month Orders </h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body p-1">
                                        <h4 class="font-large-1 text-bold-400">{{ $totalMonthOrders }}<i class="ft-layers float-right"></i></h4>
                                    </div>
                                    <div class="card-footer p-1">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
