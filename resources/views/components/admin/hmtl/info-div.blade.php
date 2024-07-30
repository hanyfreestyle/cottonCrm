@if($allData)
    <div class="infoDiv {{$col}} {{$colRow}}">
        <div class="title">{{$t}}</div>
        <div class="des">{{$des ?? ''}}</div>
    </div>
@else
    @if($des)
        <div class="infoDiv {{$col}} {{$colRow}}">
            <div class="title">{{$t}}</div>
            <div class="des">{{$des ?? ''}}</div>
        </div>
    @endif
@endif
