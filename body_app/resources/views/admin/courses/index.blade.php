@extends('admin.layout.interface')

@section('content')

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-colored-controls">Courses</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Price</th>
                                <th>Language</th>
                                <th>Valid Till</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)

                                <tr>

                                    <td>{{ $course->name}}</td>
                                    <td>{{ $course->author}}</td>
                                    <td>{{ $course->price}}</td>
                                    <td>{{ $course->language}}</td>
                                    <td>{{ $course->validTill}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('course.view',['id'=>$course->id]) }}">
                                            <i class="fas fa-trash">
                                            </i>
                                            View
                                        </a>

                                        <a class="btn btn-info btn-sm" href="{{route('course.edit',['id'=>$course->id])}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
