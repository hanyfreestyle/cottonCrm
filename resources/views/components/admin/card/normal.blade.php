@if($isactive)
    <div class="adminCard {{$col}}" >
        <div class="card card-{{$bg}} {{$outline_style}}">
            @if($title)
                <div class="card-header"><h3 class="card-title">{!! $icon . $title !!}</h3></div>
            @endif
            <div class="card-body">
                    {{$slot}}
            </div>
        </div>
    </div>
@endif

