@extends('admin.layout.interface')
@include('admin.layout.breadcrumbs',
['breadcrumbs' =>
    ['title' => 'Dashbaord',
     'items' => [
         ['name' => 'Home', 'url' => url("/"), 'active' => false],
         ['name' => 'Add Course', 'url' => null, 'active' => true],
     ]
    ]
])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-colored-controls">Edit Course</h4>
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
                                <h4 class="form-section"><i class="la la-eye"></i> Course Detail</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            {{-- <div class="col-md-1"></div> --}}
                                            <div class="col-md-4">
                                                <div class="card mx-auto d-block" style="width: 18rem;">
                                                    <img class="card-img-top" src="{{ asset('') }}{{ $course->coverImage }}" alt="Card image cap">

                                                  </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1" style="text-align: center">Name <span class="text-danger">*</span></label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="name"
                                                                    class="form-control border-primary" value="{{ $course->name }}" placeholder="Name" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1" style="text-align: center">Author <span class="text-danger">*</span></label>
                                                            <div class="col-md-10">
                                                                <input type="text"  name="author"
                                                                       class="form-control border-primary" value="{{ $course->author }}" placeholder="Author"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput3" style="text-align: center">Price <span class="text-danger">*</span></label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control border-primary"
                                                                       placeholder="Price" name="price" value="{{ $course->price }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput2">Language <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control border-primary"
                                                       placeholder="Language" name="language" value="{{ $course->language }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Valid Till <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                 <input type="date" class="form-control border-primary"
                                                     name="validTill" value="{{ $course->validTill }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Cover Image</label>
                                            <div class="col-md-9">
                                                 <input type="file" class="form-control border-primary"
                                                     name="coverImage">
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
