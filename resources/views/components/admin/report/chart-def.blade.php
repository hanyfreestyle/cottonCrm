<div class="My_Chart_Container">
    <div id="{{$id}}" class="placeholder"></div>
</div>
<div class="My_Chart_Legend {{$id}}"></div>
@push('JsCode')
    <script type="text/javascript">
        $(document).on("click", ".changeOpen", function () {
            @include('admin.mainView.chart.jsCode')
        });
        @include('admin.mainView.chart.jsCode')
    </script>
@endpush
