@if(IsArr($modelSettings,$controllerName."_report_filter_option",0))
    <div class="row formForgetBut">
        <x-admin.form.select-arr name="r_collapsed_open" sendvalue="{{issetArr($session,'r_collapsed_open',true)}}" :labelview="false"
                                 :add-label-option="false" select-type="DefCat" :send-arr="$DefCat['filter_card_open']"  col="2"/>

        <x-admin.form.select-arr name="filter_last_add" sendvalue="{{issetArr($session,'filter_last_add',true)}}" :labelview="false"
                                 :add-label-option="false" select-type="DefCat" :send-arr="$DefCat['filter_last_add']"  col="2"/>
    </div>
@endif


