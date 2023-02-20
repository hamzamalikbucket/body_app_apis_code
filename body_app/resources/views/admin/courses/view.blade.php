@extends('admin.layout.interface')
@include('admin.layout.breadcrumbs',
['breadcrumbs' =>
    ['title' => 'Dashbaord',
     'items' => [
         ['name' => 'Home', 'url' => url("/"), 'active' => false],
         ['name' => 'Course Detail', 'url' => null, 'active' => true],
     ]
    ]
])
@section('content')

<div class="row mt-4">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="horz-layout-colored-controls">Course Topics</h4>
            </div>
            <div class="card-body">
                @foreach ($course->topics as $topic)
                    <div class="card" style="box-shadow: 2px 2px 16px 1px !important;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Topic:
                                        </div>
                                        <div class="col-md-6">
                                            <span>{{ $topic->topic }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="text-align: end">
                                    <a href="{{ route('topic.edit',['id' => $topic->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                </div>
                            </div>
                            @if (!empty($topic->pdf))
                                <div class="row">
                                    <div class="col-md-3">
                                        PDF:
                                    </div>
                                    <div class="col-md-9">
                                        <a href="{{ asset('storage') }}/{{ $topic->pdf }}">View PDF</a>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-3">
                                    Video Links:
                                </div>
                                @php
                                    $topic->videoLink = explode(',',$topic->videoLink);
                                @endphp
                                <div class="col-md-9">
                                    @foreach ($topic->videoLink as $link)
                                        <a href="{{ $link }}" class="btn btn-sm btn-info">Video</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

