@if($viewbut)
    <a href="{{$url}}"
       @if($id)
       id="{{$id}}"
       @endif
       @if($target)
       target="_blank"
       @endif
       @if($tip)
       data-toggle="tooltip" data-placement="top" title="{{$printLable}}"
       @endif
       class="adminButMobile btn {{$size}} btn-{{$bg}} {{$sweetDelClass}}">
        @if($icon)
            <i class="fa {{$icon}}"></i> @if(!$tip) @endif
        @endif
        @if(!$tip)
            <span class="tipName"> {{$printLable}}</span>
        @endif
    </a>
@endif
