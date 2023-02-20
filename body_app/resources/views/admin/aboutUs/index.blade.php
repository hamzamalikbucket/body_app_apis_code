@extends('admin.layout.interface')
@include('admin.layout.breadcrumbs',
['breadcrumbs' =>
    ['title' => 'Dashbaord',
     'items' => [
         ['name' => 'Home', 'url' => url("/"), 'active' => false],
         ['name' => 'AboutUs', 'url' => null, 'active' => true],
     ]
    ]
])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-colored-controls">About Us</h4>
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
                                <h4 class="form-section"><i class="la la-eye"></i> AboutUs Details</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Heading <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" name="heading"
                                                    class="form-control border-primary" value="{{ isset($aboutUs) ? $aboutUs->heading : '' }}" placeholder="Heading" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Description <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                <textarea name="description" class="form-control border-primary summernote" placeholder="Enter Description Here" required>{{ isset($aboutUs) ? $aboutUs->description : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
