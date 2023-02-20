@extends('admin.layout.interface')
@include('admin.layout.breadcrumbs',
['breadcrumbs' =>
    ['title' => 'Dashbaord',
     'items' => [
         ['name' => 'Home', 'url' => url("/"), 'active' => false],
         ['name' => 'ContactUs', 'url' => null, 'active' => true],
     ]
    ]
])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-colored-controls">FAQs</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Mobile</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactUs as $info)
                                <tr>
                                    <td>{{ $info->user->name }}</td>
                                    <td>{{ $info->name }}</td>
                                    <td>{{ $info->email }}</td>
                                    <td>{{ $info->message }}</td>
                                    <td>{{ $info->mobile }}</td>
                                    <td>{{ \Carbon\Carbon::parse($info->created_at)->isoFormat("MMM D YYYY") }}</td>
                                    <td>
                                        <select name="action" class="form-control action" >
                                            <option value="">Select</option>
                                            <option value="response" email="{{ $info->email }}">Response</option>
                                            <option value="delete" id="{{ $info->id }}">Delete</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title" id="myModalLabel17">Response to User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" id="successAlert" style="display: none"></div>
                    <div class="alert alert-danger" id="dangerAlert" style="display: none"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-12 label-control" for="userinput1">Message <span class="text-danger">*</span></label>
                                <div class="col-md-12">
                                    <textarea name="message" id="message" class="form-control border-primary summernote" placeholder="Enter Description Here" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="send">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load',function(){
            var email = '';
            $('.action').on('change',function () {
                let selectedOption = $(this).find('option:selected');
                if($(this).val() == 'response'){
                    email = selectedOption.attr('email');
                    $('#large').modal('show');
                    $('.summernote').summernote('reset');
                }else if($(this).val() == 'delete')
                {
                    let id = selectedOption.attr('id');
                    let cnfrm = confirm('Are You Sure You Want to Delete')
                    {
                        if(cnfrm){
                            $.ajax({
                                type: "method",
                                method: "delete",
                                url: "{{ route('delete.contactus') }}",
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: id
                                },
                                dataType: "json",
                                success: function (response) {
                                    if(response.success){
                                        window.location.reload();
                                    }
                                }
                            });
                        }
                    }
                }
            });

            $('#send').on('click',function(){
                let message = $('#message').val();
                if($(".summernote").summernote('isEmpty')){
                    $('#dangerAlert').show();
                    $('#dangerAlert').html('Message Body is required')
                }else{
                    $(this).prop('disabled',true);
                    $.ajax({
                        type: "method",
                        method: "post",
                        url: "{{ route('user.response.email') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            email: email,
                            message: message,
                        },
                        dataType: "json",
                        success: function (response) {
                            if(response.success){
                                $('#send').prop('disabled',false);
                                $('#dangerAlert').hide();
                                $('#successAlert').show();
                                $('#successAlert').html('Email Send Successfully');
                                setTimeout(() => {
                                    $('#large').modal('hide');
                                    $('#dangerAlert').hide();
                                    $('#successAlert').hide();
                                }, 1500);
                            }
                        }
                    });
                }
            })
        })
    </script>
@endsection
