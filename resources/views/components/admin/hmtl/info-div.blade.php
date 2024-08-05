@if($vType == 'text')
    @if($allData)
        <div class="infoDiv {{$col}}">
            <div class="title"><i class="{{$i}}"></i> {{$t}}
                @if($subDes)
                    : <span class="span_des">{{$des ?? ''}}</span>
                @endif
            </div>
            @if(!$subDes)
                <div class="des">{{$des ?? ''}}</div>
            @endif

        </div>
    @else
        @if($des)
            <div class="infoDiv {{$col}}">
                <div class="title"><i class="{{$i}}"></i> {{$t}}
                    @if($subDes)
                       : <span class="span_des">{{$des ?? ''}}</span>
                    @endif
                </div>
                @if(!$subDes)
                    <div class="des">{{$des ?? ''}}</div>
                @endif
            </div>
        @endif
    @endif
@elseif($vType == 'icon')
    @if($des)
        <div class="infoDiv_icon {{$col}}">
            <div class="des {{$s}}"><i class="{{$i}}"></i> {{$des}}</div>
        </div>
    @endif
@endif

