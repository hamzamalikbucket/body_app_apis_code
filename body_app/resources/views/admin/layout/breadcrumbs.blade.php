
@if (isset($breadcrumbs))
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">{{$breadcrumbs['title']}}</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">

                        @foreach ($breadcrumbs['items'] as $item)
                            @if ($item['active'] == false)
                            <li class="breadcrumb-item"><a href="{{$item['url'] != null ? $item['url'] : '#'}}">{{$item['name']}}</a>
                            </li>
                            @endif
                        @endforeach

                        @php $count = 0 @endphp
                        @foreach ($breadcrumbs['items'] as $item)
                            @if ($item['active'] == true && $count == 0)
                                <li class="breadcrumb-item active">{{$item['name']}}
                                </li>
                                @php $count++  @endphp
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>

@endif
