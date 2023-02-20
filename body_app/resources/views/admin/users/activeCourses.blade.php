@extends('admin.layout.interface')

@section('content')

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-colored-controls">Active Courses</h4>
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
                                <th>Course Name</th>
                                <th>Price</th>
                                <th>Purchase Date</th>
                                {{-- <th>Valid Till</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0
                            @endphp
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->price }}</td>
                                    <td>{{ $course->purchaseDate }}</td>
                                    {{-- <td>{{ $course->valid_till }}</td> --}}
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
            }
        })
    })
</script>
@endsection
