<div class="box_form">
    @if($title)
        <span class="box_title">{{$title}}</span>
    @endif
    <input type="hidden" name="phoneAreaCode" value="{{$Config['phoneAreaCode']}}" dir="ltr">
    <div class="row">
        <x-admin.form.input name="name" :row="$rowData" :label="__($defLang.'form_name')" col="6" tdir="ar"/>
        @if($Config['evaluation'])
            <x-admin.form.select-data name="evaluation_id" :row="$rowData" cat-id="EvaluationCust" :label="__($defLang.'form_evaluation')" :req="false"/>
        @endif
        @if($Config['gender'])
            <x-admin.form.select-arr name="gender_id" select-type="DefCat" :row="$rowData" :send-arr="$DefCat['gender']" :label="__($defLang.'form_gender')" col="3" :req="false"/>
        @endif

    </div>

    <div class="row">
        <x-admin.form.phone name="mobile" :row="$rowData" :label="__($defLang.'form_mobile')"
                            :initial-country="issetArr($rowData,'mobile_code',$Config['defCountry'])" col="3"/>

        <x-admin.form.phone name="mobile_2" :row="$rowData" :label="__($defLang.'form_mobile_2')"
                            :initial-country="issetArr($rowData,'mobile_2_code',$Config['defCountry'])" col="3" :req="false"/>

        <x-admin.form.phone name="phone" :row="$rowData" :label="__($defLang.'form_phone')"
                            :initial-country="issetArr($rowData,'phone_code',$Config['defCountry'])" col="3" :req="false"/>

        <x-admin.form.phone name="whatsapp" :row="$rowData" :label="__($defLang.'form_whatsapp')"
                            :initial-country="issetArr($rowData,'whatsapp_code',$Config['defCountry'])" col="3" :req="false"/>
    </div>

    <div class="row">
        <x-admin.form.input name="email" :row="$rowData" :label="__($defLang.'form_email')" col="3" tdir="en" :req="false"/>
    </div>
</div>




