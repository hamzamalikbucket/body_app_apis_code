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
                    <h4 class="card-title" id="horz-layout-colored-controls">Add Topic</h4>
                </div>
                <div class="card-content collpase show">

                    <div class="card-body">
                        @if (session()->has('success') || session()->has('error'))
                            <div class="alert alert-{{session()->has('success') ? 'success' : 'danger'}}">
                                {{session()->has('success') ? session()->get('success') : session()->get('error')}}
                            </div>
                        @endif
                        <form class="form form-horizontal" action="" method="POST" enctype="multipart/form-data" id="topicForm">
                            @csrf
                            <input type="hidden" name="courseID" value="{{ $courseID }}">
                            <div class="form-body" id="topicWrapper">
                                <h4 class="form-section"><i class="la la-eye"></i> Topic Details</h4>
                                <div class="row" id="topic">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Topic <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" name="topic"
                                                    class="form-control border-primary"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end my-2">
                                                <button class="btn btn-success btn-sm" id="addMore"><i class="fas fa-add"></i> Add More</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 singleType" quesNo="0">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="userinput1">Name <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="name[]"
                                                            class="form-control border-primary name" placeholder="Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Type <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                <select name="type[]" class="form-control typeDropdown" required>
                                                    <option value="">-----Select Type-----</option>
                                                    <option value="1">video</option>
                                                    <option value="2">pdf</option>
                                                    <option value="3">Address Url</option>
                                                    <option value="4">text</option>
                                                    <option value="5">Quiz</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 optionTab videoLink" style="display: none">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="userinput1">Video Link <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="videoLink[]"
                                                            class="form-control border-primary field"  >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 optionTab quiz" style="display: none">
                                                <div class="col-12 d-flex justify-content-end my-2">
                                                    <button class="btn btn-success btn-sm addMore" ><i class="fas fa-add"></i> Add More Question</button>
                                                </div>
                                                <div class="row ques" quizNo=-1>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1">Heading <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="heading[0][]" prefix="heading"
                                                                    class="form-control border-primary quesField field" placeholder="Heading" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1">Question Type <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <select name="qT[0][]" class="form-control quesType quesField field" prefix="qT">
                                                                    <option value="">--Select--</option>
                                                                    <option value="text">Text</option>
                                                                    <option value="image">Image</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1">Correct Option <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <select name="c_opt[0][]" prefix="c_opt" class="form-control quesField field" >
                                                                    <option value="">----Select-----</option>
                                                                        <option value="opt_1">Option(1)</option>
                                                                        <option value="opt_2">Option(2)</option>
                                                                        <option value="opt_3">Option(3)</option>
                                                                        <option value="opt_4">Option(4)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(1) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_1[0][]" prefix="opt_1"  class="form-control quesField field" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(2) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_2[0][]" prefix="opt_2" class="form-control quesField field" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(3) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_3[0][]" prefix="opt_3" class="form-control quesField field" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(4) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_4[0][]" prefix="opt_4"  class="form-control quesField field" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(1) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_1[0][]" prefix="opt_1"  class="form-control quesField " >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(2) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_2[0][]" prefix="opt_2" class="form-control quesField " >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(3) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_3[0][]" prefix="opt_3" class="form-control quesField " >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(4) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_4[0][]" prefix="opt_4"  class="form-control quesField " >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 optionTab text" style="display: none">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="userinput1">text <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                       <textarea name="text[]" class="form-control field"  rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 optionTab addressUrl"  style="display: none">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="userinput1">Address Url <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="addressUrl[]"
                                                            class="form-control border-primary field"  >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 optionTab pdf" style="display: none">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="userinput1">Pdf <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                       <input type="file" name="pdf[]" class="form-control field">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <button class="btn btn-primary nextBtn">
                                    <input type="hidden" name="next" id="nextStatus">
                                    <i class="la la-check-square-o"></i> Save & Next
                                </button>
                                {{-- <a href="{{ route('course.addQuiz',['courseID' => $courseID]) }}" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Next
                                </a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load',function(){

            var quizQuestionCount = -1 ;
            function questionCountManger(action='',parentDiv='')
            {
                let count = 0;
                $('.singleType').each(function(){
                    let typeDropdown = $(this).find('.typeDropdown');
                    if(typeDropdown.val() == 5){
                        let ques = $(this).find('.ques');
                        let quizQuesFields = $(this).find('.quesField');
                        ques.attr('quizNo',count);
                        quizQuesFields.each(function(){
                            let prefix = $(this).attr('prefix');
                            let name = `${prefix}[${count}][]`;
                            $(this).attr('name',name);
                        })
                        count++;
                    }
                })
            }

            $('#addMore').on('click',function(event){
                event.preventDefault();
                let topicWrapper = $('#topicWrapper');
                let type = `<div class="col-md-12 singleType" quesNo="${quizQuestionCount}">
                                    <div class="col-12 d-flex justify-content-end my-2">
                                        <button type="button" class="btn btn-danger btn-sm deleteTopic" ><i class="fas fa-trash"></i> Delete</button>
                                    </div>
                                    <div class="form-group row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="userinput1">Name <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="name[]"
                                                            class="form-control border-primary name" placeholder="Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 label-control" for="userinput1">Type <span class="text-danger">*</span></label>
                                            <div class="col-md-8">
                                                <select name="type" class="form-control typeDropdown" required>
                                                    <option value="">-----Select Type-----</option>
                                                    <option value="1">video</option>
                                                    <option value="2">pdf</option>
                                                    <option value="3">Address Url</option>
                                                    <option value="4">text</option>
                                                    <option value="5">Quiz</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 optionTab videoLink" style="display: none">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="userinput1">Video Link <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="videoLink[]"
                                                            class="form-control border-primary field"  >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 optionTab quiz" style="display: none">
                                                <div class="col-12 d-flex justify-content-end my-2">
                                                    <button class="btn btn-success btn-sm addMore" ><i class="fas fa-add"></i> Add More Question</button>
                                                </div>
                                                <div class="row ques" quizNo="${quizQuestionCount}">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1">Heading <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="heading[0][]" prefix="heading"
                                                                    class="form-control border-primary quesField field" placeholder="Heading" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1">Question Type <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <select name="quesType" class="form-control quesType quesField field" prefix="qT">
                                                                    <option value="">--Select--</option>
                                                                    <option value="text">Text</option>
                                                                    <option value="image">Image</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1">Correct Option <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <select name="c_opt[0][]" prefix="c_opt" class="form-control quesField field" >
                                                                    <option value="">----Select-----</option>
                                                                        <option value="opt_1">Option(1)</option>
                                                                        <option value="opt_2">Option(2)</option>
                                                                        <option value="opt_3">Option(3)</option>
                                                                        <option value="opt_4">Option(4)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(1) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_1[0][]" prefix="opt_1"  class="form-control quesField field" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(2) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_2[0][]" prefix="opt_2" class="form-control quesField field" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(3) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_3[0][]" prefix="opt_3" class="form-control quesField field" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(4) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_4[0][]" prefix="opt_4"  class="form-control quesField field" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(1) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_1[0][]" prefix="opt_1"  class="form-control quesField " >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(2) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_2[0][]" prefix="opt_2" class="form-control quesField " >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(3) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_3[0][]" prefix="opt_3" class="form-control quesField " >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(4) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_4[0][]" prefix="opt_4"  class="form-control quesField " >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 optionTab text" style="display: none">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="userinput1">text <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                       <textarea name="text[]" class="form-control field"  rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 optionTab addressUrl"  style="display: none">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="userinput1">Address Url <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="addressUrl[]"
                                                            class="form-control border-primary field"  >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 optionTab pdf" style="display: none">
                                                <div class="form-group row">
                                                    <label class="col-md-2 label-control" for="userinput1">Pdf <span class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                       <input type="file" name="pdf[]" class="form-control field">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                topicWrapper.append(type);
            });

            $( "#topicWrapper" ).delegate( ".deleteTopic", "click", function(event) {
                event.preventDefault();
                let r = confirm('Are You Sure You Want to Delete?');
                if(r){
                    let parentDive = $(this).parent().parent();
                    questionCountManger('delete',parentDive);
                    parentDive.remove();
                }
            });


            function manageOptions(current = '',parent = '') {

                let allOptions = parent.find('.optionTab');
                let currentClassName = '.'+current;
                let nameForCurrent = current+'Name[]';

                parent.find(currentClassName).show();
                parent.find('.name').attr('name',nameForCurrent);
                parent.find('.field').attr('required',true);
                current == 'quiz' ? questionCountManger('add',parent) : '';

                allOptions.each(function(){
                    if(!$(this).hasClass(current)){
                        $(this).find('.field').attr('required',false);
                        $(this).find('.field').val(null);
                        $(this).hide();
                    }
                })
            }

            $( "#topicWrapper" ).delegate( ".typeDropdown", "change", function(event) {
                let parent = $(this).parent().parent().parent();
                let selectedValue = $(this).find('option:selected').val();
                if(selectedValue == 1)
                {
                    manageOptions('videoLink',parent);
                }
                else if(selectedValue == 2)
                {
                    manageOptions('pdf',parent);
                }
                else if(selectedValue == 3)
                {
                    manageOptions('addressUrl',parent);
                }
                else if(selectedValue == 4)
                {
                    manageOptions('text',parent);
                }
                else if(selectedValue == 5)
                {
                    manageOptions('quiz',parent);
                }
            });


            $( "#topicWrapper" ).delegate( ".addMore", "click", function(event) {
                event.preventDefault();
                let currentQuizQuestionWrapper = $(this).parent().parent();

                let ques = `<div class="row ques">
                                    <div class="col-12 d-flex justify-content-end my-2">
                                        <button type="button" class="btn btn-danger btn-sm deleteQues" ><i class="fas fa-trash"></i> Delete Question</button>
                                    </div>
                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1">Heading <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="heading[${quizQuestionCount}][]" prefix="heading"
                                                                    class="form-control border-primary quesField field" placeholder="Heading" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1">Question Type <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <select name="quesType[${quizQuestionCount}][]" class="form-control quesType quesField field" prefix="qT">
                                                                    <option value="">--Select--</option>
                                                                    <option value="text">Text</option>
                                                                    <option value="image">Image</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="col-md-2 label-control" for="userinput1">Correct Option <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <select name="c_opt[${quizQuestionCount}][]" prefix="c_opt" class="form-control quesField field" required>
                                                                    <option value="">----Select-----</option>
                                                                        <option value="opt_1">Option(1)</option>
                                                                        <option value="opt_2">Option(2)</option>
                                                                        <option value="opt_3">Option(3)</option>
                                                                        <option value="opt_4">Option(4)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(1) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_1[${quizQuestionCount}][]" prefix="opt_1"  class="form-control quesField field" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(2) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_2[${quizQuestionCount}][]" prefix="opt_2" class="form-control quesField field" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(3) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_3[${quizQuestionCount}][]" prefix="opt_3" class="form-control quesField field" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 textOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(4) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="opt_4[${quizQuestionCount}][]" prefix="opt_4"  class="form-control quesField field" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(1) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_1[${quizQuestionCount}][]" prefix="opt_1"  class="form-control quesField ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(2) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_2[${quizQuestionCount}][]" prefix="opt_2" class="form-control quesField " >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(3) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_3[${quizQuestionCount}][]" prefix="opt_3" class="form-control quesField " >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 imageOption d-none">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Option(4) <span class="text-danger">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="opt_4[${quizQuestionCount}][]" prefix="opt_4"  class="form-control quesField ">
                                                            </div>
                                                        </div>
                                                    </div>
                                </div>`;
                    currentQuizQuestionWrapper.append(ques);
                    questionCountManger()
            });

            $( "#topicWrapper" ).delegate( ".deleteQues", "click", function(event) {
                event.preventDefault();
                let r = confirm('Are You Sure You Want to Delete?');
                if(r){
                    $(this).parent().parent().remove();
                }
            });

            $('#topicWrapper').delegate(".quesType","change",function(event){
                let quesTypeValue = $(this).val();
                let quesParent = $(this).parent().parent().parent().parent();

                if(quesTypeValue == 'image'){
                    $(quesParent).find('.imageOption').each(function () {
                        $(this).removeClass('d-none');
                        $(this).find('.quesField').attr('required',true);
                    })
                    $(quesParent).find('.textOption').each(function () {
                        $(this).addClass('d-none');
                        $(this).find('.quesField').attr('required',false);
                    })
                }else{
                    $(quesParent).find('.imageOption').each(function () {
                        $(this).addClass('d-none');
                        $(this).find('.quesField').attr('required',false);
                    })
                    $(quesParent).find('.textOption').each(function () {
                        $(this).removeClass('d-none');
                        $(this).find('.quesField').attr('required',true);
                    })
                }
            });



            $('.nextBtn').on('click',function(){
                $('#nextStatus').val('next');
            })
        })
    </script>
@endsection

