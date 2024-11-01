<form class="mainForm pb-0" action="{{route('admin.config.model.update')}}" method="post">
    @csrf
    <input type="hidden" value="{{$modelname}}" name="model_id">
    <input type="hidden" value="{{$PrefixRoute}}" name="PrefixRoute">
    <div class="row">
        <input type="hidden" value="{{$modelname}}" name="model_id">

        <x-admin.form.input :label="__('admin/config/settings.set_perpage')" name="{{$modelname}}_perpage"
                            dir="ar" colrow="col-lg-2 col-6"
                            value="{{old($modelname.'_perpage',IsArr($modelSettings,$modelname.'_perpage',10))}}"/>


        @if(IsConfig($settings,'report'))
            <x-admin.form.select-arr label="{{ __('admin/config/settings.set_filter_option') }}" name="{{$modelname}}_report_filter_option" col="2" type="selActive"
                                     :sendvalue="getSettingValue($modelname, $modelSettings, 'report_filter_option')"/>

        @endif
    </div>


    <div class="row">
        @if(IsConfig($config,'postPhotoAdd',0) )
            <x-admin.form.select-arr :l="__('admin/config/settings.set_filter_id')" name="{{$modelname}}_filterid" col="2" :send-arr="$filterTypes"
                                     :sendvalue="getSettingValue($modelname, $modelSettings, 'filterid')"/>

            <x-admin.form.select-arr :l="__('admin/config/settings.set_view_photo')" name="{{$modelname}}_view_photo" col="2" type="selActive"
                                     :sendvalue="getSettingValue($modelname, $modelSettings, 'view_photo')"/>

            <x-admin.form.select-arr :l="__('admin/config/settings.set_filter_form')" name="{{$modelname}}_select_filter_form" col="2" type="selActive"
                                     :sendvalue="getSettingValue($modelname, $modelSettings, 'select_filter_form')"/>
        @endif
        @if(IsConfig($config,'TableMorePhotos',0))
            <x-admin.form.select-arr :l="__('admin/config/settings.set_filter_filter_more_photo')" name="{{$modelname}}_morephoto_filterid" col="2" :send-arr="$filterTypes"
                                     :sendvalue="getSettingValue($modelname, $modelSettings, 'morephoto_filterid')"/>

        @endif

        @if(IsConfig($config,'categoryIcon',0))
            <x-admin.form.select-arr :l="__('admin/config/settings.set_iconfilter_id')" name="{{$modelname}}_iconfilterid" col="2" :send-arr="$filterTypes"
                                     :sendvalue="getSettingValue($modelname, $modelSettings, '_iconfilterid')"/>
        @endif

    </div>


    <div class="row">
        @if($controllerName == 'ProductList')
            <x-admin.form.select-arr :l="__('admin/proProduct.cat_text_name')" name="{{$modelname}}_category_view" col="2" type="selActive"
                                     :sendvalue="getSettingValue($modelname, $modelSettings, 'category_view')"/>

            <x-admin.form.select-arr :l="__('admin/proProduct.app_menu_brand')" name="{{$modelname}}_brand_view" col="2" type="selActive"
                                     :sendvalue="getSettingValue($modelname, $modelSettings, 'brand_view')"/>

            <x-admin.form.select-arr :l="__('admin/proProduct.pro_text_price')" name="{{$modelname}}_price_view" col="2" type="selActive"
                                     :sendvalue="getSettingValue($modelname, $modelSettings, 'price_view')"/>

        @endif
        @if($controllerName == 'BlogPost')
            <x-admin.form.select-arr :label="__('admin/def.label_published_user')" name="{{$modelname}}_dataTableUserName" col="2" :req="false" type="selActive"
                                     :sendvalue="getSettingValue($modelname, $modelSettings, 'dataTableUserName')"/>
        @endif
    </div>

    {{$slot}}

    @if(isset($pageData['ModelId']))
        <input type="hidden" name="ModelId" value="{{$pageData['ModelId']}}">
    @endif
    <x-admin.form.submit-role-back :page-data="$pageData"/>
</form>

