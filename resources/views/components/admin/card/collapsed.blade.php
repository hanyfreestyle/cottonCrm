<div class="adminCard card {{$outline}} card-{{$bg}} {{$collapsed_style}}">
    <div class="card-header {{$header_filter}}">
        @if($title)
            <h3 class="card-title">{{$title}}</h3>
        @endif
        @if($collapsed)
            <div class="card-tools">
                <button type="button" class="btn btn-tool changeOpen" data-card-widget="collapse"><i class="{{$open_style}}"></i></button>
            </div>
        @endif
    </div>
    <div class="card-body">
        {{$slot}}
    </div>
</div>

@push('JsCode')
{{--    <script type="text/javascript">--}}
{{--        $(document).on("click",".changeOpen",function() {--}}
{{--            $(".My_Chart_Container").each(function ()--}}
{{--            {--}}
{{--                $(this).css("display", "block");--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endpush

