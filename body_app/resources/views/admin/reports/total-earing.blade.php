@extends('admin.layout.interface')
@include('admin.layout.breadcrumbs',
['breadcrumbs' =>
    ['title' => 'Dashbaord',
     'items' => [
         ['name' => 'Home', 'url' => url("/"), 'active' => false],
         ['name' => 'Stripe', 'url' => null, 'active' => true],
     ]
    ]
])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-colored-controls">Total Earning Report</h4>
                </div>
                <div class="card-content collpase show">

                    <div class="card-body">
                        @if (session()->has('success') || session()->has('error'))
                            <div class="alert alert-{{session()->has('success') ? 'success' : 'danger'}}">
                                {{session()->has('success') ? session()->get('success') : session()->get('error')}}
                            </div>
                        @endif
                        <form class="form form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="la la-eye"></i>Filter Report</h4>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Start Date <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="date" name="start_date"
                                                    class="form-control border-primary" value="" placeholder="Api Key" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">End Date <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="date"  name="end_date"
                                                    class="form-control border-primary" value="" placeholder="Api Secret" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col">
            <div class="card">
                @if (session()->has('start_date') && session()->has('end_date'))
                    <div class="card-header pb-1">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="font-weight-bold">Start Date: </label> <span>{{ session()->get('start_date') }}</span>
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold">End Date: </label> <span>{{ session()->get('end_date') }}</span>
                            </div>
                        </div>
                    </div><hr class="m-0">
                @endif
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-colored-controls">Report Detail</h4>
                </div>
                @if (session()->has('success') || session()->has('error'))
                            <div class="alert alert-{{session()->has('success') ? 'success' : 'danger'}}">
                                {{session()->has('success') ? session()->get('success') : session()->get('error')}}
                            </div>
                        @endif

                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>User</th>
                                <th>Courses</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                                $amount = 0;
                            @endphp
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->courses }}</td>
                                    <td>{{ $order->amount }}</td>
                                </tr>
                                @php
                                    $amount += $order->amount;
                                @endphp
                            @endforeach
                            <tr>
                                <th colspan="3" style="text-align: right">Total</th>
                                <th>{{ $amount }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
