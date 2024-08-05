<div class="adminCard card {{$outline}} card-{{$bg}} {{$collapsed_style}}">
    <div class="card-header">
        @if($title)
            <h3 class="card-title">{{$title}}</h3>
        @endif
        @if($collapsed)
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="{{$open_style}}"></i></button>
            </div>
        @endif
    </div>
    <div class="card-body">
        {{$slot}}
    </div>
</div>
