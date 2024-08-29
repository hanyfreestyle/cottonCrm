@if($type == 'normal')
    <div class="{{$col}}">
        <a href="{{$url}}">
            <div class="small-box bg-{{$bg}}">
                <div class="inner">
                    <h3>{{number_format($count)}}</h3>
                    <p>{{$title}}</p>
                </div>

                @if($icon)
                    <div class="icon">
                        <i class="{{$icon}}"></i>
                    </div>
                @endif
            </div>
        </a>
    </div>
@elseif($type == 'closed')
    <div class="{{$col}}">
        <div class="small-box bg-{{$bg}}">
            <div class="inner">
                <h3>{{number_format($count)}}</h3>
                <p>{{$title}}</p>
            </div>
            <div class="icon">
                <i class="{{$icon}}"></i>
            </div>
        </div>
    </div>
@endif

