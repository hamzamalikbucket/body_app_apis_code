@extends('admin.layout.interface')
@include('admin.layout.breadcrumbs',
['breadcrumbs' =>
    ['title' => 'Dashbaord',
     'items' => [
         ['name' => 'Home', 'url' => url("/"), 'active' => false],
         ['name' => 'Add Topic', 'url' => null, 'active' => true],
     ]
    ]
])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('course.view' , ['id' => $topic->course->id]) }}" class="btn btn-primary">Back</a>
                         </div>
                    </div>

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
                            <div class="form-body" id="topicWrapper">
                                <h4 class="form-section"><i class="la la-eye"></i> Edit Topic </h4>
                                <div class="row" id="topic">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Topic</label>
                                            <div class="col-md-8">
                                                <input type="text" name="topic"
                                                    class="form-control border-primary" value="{{ $topic->topic }}" placeholder="Topic" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Video Link</label>
                                            <div class="col-md-8">
                                               <textarea name="videoLink"  class="form-control" placeholder="Enter Comma Seprated Links"  rows="5">{{ $topic->videoLink }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Pdf</label>
                                            <div class="col-md-8">
                                               <input type="file" name="pdf" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body" id="quizWrapper">
                                <h4 class="form-section"><i class="la la-eye"></i>Edit Quize</h4>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end my-2">
                                        <button class="btn btn-success btn-sm" id="addMore"><i class="fas fa-add"></i> Add More</button>
                                    </div>
                                </div>
                                @foreach ($topic->questions as $que)
                                <div class="row" id="ques">
                                    <div class="col-12 d-flex justify-content-end my-2">
                                        <button type="button" class="btn btn-danger btn-sm deleteQues" ><i class="fas fa-trash"></i> Delete</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Heading</label>
                                            <div class="col-md-8">
                                                <input type="text" value="{{ $que->heading }}" name="heading[]"
                                                    class="form-control border-primary" placeholder="Heading" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Correct Option</label>
                                            <div class="col-md-8">
                                                <select name="c_opt[]" class="form-control" required>
                                                    <option value="">----Select-----</option>
                                                        <option value="opt_1" {{ $que->c_opt == 'opt_1' ? 'selected' : ''  }} >Option(1)</option>
                                                        <option value="opt_2" {{ $que->c_opt == 'opt_2' ? 'selected' : ''  }} >Option(2)</option>
                                                        <option value="opt_3" {{ $que->c_opt == 'opt_3' ? 'selected' : ''  }} >Option(3)</option>
                                                        <option value="opt_4" {{ $que->c_opt == 'opt_4' ? 'selected' : ''  }} >Option(4)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Option(1)</label>
                                            <div class="col-md-8">
                                                <input type="text" value="{{ $que->opt_1 }}" name="opt_1[]"  class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Option(2)</label>
                                            <div class="col-md-8">
                                                <input type="text" value="{{ $que->opt_2 }}" name="opt_2[]"  class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Option(3)</label>
                                            <div class="col-md-8">
                                                <input type="text" value="{{ $que->opt_3 }}" name="opt_3[]"  class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Option(4)</label>
                                            <div class="col-md-8">
                                                <input type="text" value="{{ $que->opt_4 }}" name="opt_4[]"  class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
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
    <script>
        window.addEventListener('load',function(){
            $('#addMore').on('click',function(event){
                event.preventDefault();
                let quizWrapper = $('#quizWrapper');
                let ques = `<div class="row" id="ques">
                                    <div class="col-12 d-flex justify-content-end my-2">
                                        <button type="button" class="btn btn-danger btn-sm deleteQues" ><i class="fas fa-trash"></i> Delete</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Heading</label>
                                            <div class="col-md-8">
                                                <input type="text" name="heading[]"
                                                    class="form-control border-primary" placeholder="Heading" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Correct Option</label>
                                            <div class="col-md-8">
                                                <select name="c_opt[]" class="form-control" required>
                                                    <option value="">----Select-----</option>
                                                        <option value="opt_1">Option(1)</option>
                                                        <option value="opt_2">Option(2)</option>
                                                        <option value="opt_3">Option(3)</option>
                                                        <option value="opt_4">Option(4)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Option(1)</label>
                                            <div class="col-md-8">
                                                <input type="text" name="opt_1[]"  class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Option(2)</label>
                                            <div class="col-md-8">
                                                <input type="text" name="opt_2[]"  class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Option(3)</label>
                                            <div class="col-md-8">
                                                <input type="text" name="opt_3[]"  class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Option(4)</label>
                                            <div class="col-md-8">
                                                <input type="text" name="opt_4[]"  class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    quizWrapper.append(ques);
            });

            $( "#quizWrapper" ).delegate( ".deleteQues", "click", function(event) {
                event.preventDefault();
                let r = confirm('Are You Sure You Want to Delete?');
                if(r){
                    $(this).parent().parent().remove();
                }
            });
        })
    </script>
@endsection

