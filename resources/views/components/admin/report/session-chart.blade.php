@if(isset($chartData[$id]) and  count($chartData[$id]) > 0)
    @if(!isset($session[$key]))
        @if(IsConfig($session,'r_card_view',true))
            <div class="col-lg-3">
                <div class="col-md-12 col-sm-12 col-12 ChartBoxInfo">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="{{$i}}"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{$l}}</span>
                            @if($count)
                                <span class="info-box-number">{{number_format($count)}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <x-admin.report.chart-def id="{{$id}}" :data-row="$chartData[$id]"/>
            </div>
        @else
            <div class="col-lg-3">
                <x-admin.card.collapsed :open="IsConfig($session,'r_collapsed_open',true)" :title=" $l">
                    <x-admin.report.chart-def id="{{$id}}" :data-row="$chartData[$id]"/>
                </x-admin.card.collapsed>
            </div>
        @endif
    @endif
@endif


