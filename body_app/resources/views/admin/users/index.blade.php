@extends('admin.layout.interface')

@section('content')

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-colored-controls">User Details</h4>
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Date Of Birth</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->phone}}</td>
                                    <td>{{ $user->dob}}</td>
                                    <td>{{ $user->city}}</td>
                                    <td>{{ $user->country}}</td>
                                    <td>
                                        <form method="POST" action="{{ route('user.action') }}" class="deviceIdForm">
                                            @csrf
                                            <select name="action"  class="form-control userAction">
                                                <option value="">--Select--</option>
                                                <option value="removeId">RemoveId</option>
                                                <option value="purhis" id="{{ $user->id }}">Purchase History</option>
                                                <option value="actCrs" id="{{ $user->id }}">Active Courses</option>
                                            </select>
                                            <input type="hidden" name="userId" value="{{ $user->id }}">
                                        </form>
                                        <form action=""></form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    window.addEventListener('load',function(){
        $('.userAction').on('change',function(){
            if($(this).val() == 'removeId'){
                $(this).parent().submit();
            }else if($(this).val() == 'purhis'){
                let userId = $(this).find('option:selected').attr('id');
                window.location.href = `user/${userId}/purchaseHistory`;
            }else if($(this).val() == 'actCrs'){
                let userId = $(this).find('option:selected').attr('id');
                window.location.href = `user/${userId}/activeCourses`;
            }
        })
    })
</script>
@endsection
