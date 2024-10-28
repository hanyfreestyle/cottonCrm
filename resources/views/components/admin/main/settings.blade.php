<form class="mainForm pb-0" action="{{route('admin.config.model.update')}}" method="post">
    @csrf
    <input type="hidden" value="{{$modelname}}" name="model_id">
    <input type="hidden" value="{{$PrefixRoute}}" name="PrefixRoute">
    <div class="row">
        <input type="hidden" value="{{$modelname}}" name="model_id">

        <x-admin.form.input :label="__('admin/config/settings.set_perpage')" name="{{$modelname}}_perpage"
                            dir="ar" colrow="col-lg-2 col-6"
                            value="{{old($modelname.'_perpage',IsArr($modelSettings,$modelname.'_perpage',10))}}"/>

        @if($addPhoto)
            <x-admin.form.select-arr label="{{ __('admin/config/settings.set_filter_id') }}" name="{{$modelname}}_filterid" col="2"
                                     sendvalue="{{old($modelname.'_filterid', IsArr($modelSettings,$modelname.'_filterid',0))}}"
                                     :send-arr="$filterTypes"/>

            <x-admin.form.select-arr label="{{ __('admin/config/settings.set_view_photo') }}" name="{{$modelname}}_view_photo" col="2"
                                     sendvalue="{{old($modelname.'_view_photo', IsArr($modelSettings,$modelname.'_view_photo',0))}}" :req="false"
                                     type="selActive"/>





            @if($selectfilterid)
                <x-admin.form.select-arr :label="__('admin/config/settings.set_filter_form')" name="{{$modelname}}_select_filter_form" col="2" :req="false"
                                         sendvalue="{{old($modelname.'_select_filter_form',IsArr($modelSettings,$modelname.'_select_filter_form',0))}}"
                                         type="selActive"/>
            @endif

        @endif


        @if($addIcon)
            <x-admin.form.select-arr :l="__('admin/config/settings.set_iconfilter_id')" name="{{$modelname}}_iconfilterid" col="2"
                                     sendvalue="{{old($modelname.'_iconfilterid',IsArr($modelSettings,$modelname.'_iconfilterid',0))}}"
                                     :send-arr="$filterTypes"/>
        @endif



        @if(IsConfig($config,'TableMorePhotos') and $viewAsPost == true)
            <x-admin.form.select-arr :l="__('admin/config/settings.set_filter_filter_more_photo')" name="{{$modelname}}_morephoto_filterid" col="2"
                                     sendvalue="{{old($modelname.'_morephoto_filterid',IsArr($modelSettings,$modelname.'_morephoto_filterid',0))}}"
                                     :send-arr="$filterTypes"/>

            <x-admin.form.select-arr :label="__('admin/def.label_more_photo')" name="{{$modelname}}_morePhoto" col="2" :req="false" type="selActive"
                                     sendvalue="{{old($modelname.'_morePhoto',IsArr($modelSettings,$modelname.'_morePhoto',0))}}"/>
        @else
            <input type="hidden" name="_morePhoto" value="0">
            <input type="hidden" name="_morephoto_filterid" value="0">
        @endif


        @if(IsConfig($config,'TableMorePhotos'))



        @endif


        @if($dataTableUserName)
            <x-admin.form.select-arr :label="__('admin/def.label_published_user')" name="{{$modelname}}_dataTableUserName" col="2" :req="false" type="selActive"
                                     sendvalue="{{old($modelname.'_dataTableUserName',IsArr($modelSettings,$modelname.'_dataTableUserName',0))}}"/>
        @endif

        @if($dataTableDate)
            <x-admin.form.select-arr :label="__('admin/def.label_published_at')" name="{{$modelname}}_dataTableDate" col="2" :req="false" type="selActive"
                                     sendvalue="{{old($modelname.'_dataTableDate',IsArr($modelSettings,$modelname.'_dataTableDate',0))}}"/>
        @endif


        @if(IsConfig($settings,'report'))
            <x-admin.form.select-arr label="{{ __('admin/config/settings.set_filter_option') }}" name="{{$modelname}}_report_filter_option" col="2"
                                     sendvalue="{{old($modelname.'_report_filter_option', IsArr($modelSettings,$modelname.'_report_filter_option',0))}}" :req="false"
                                     type="selActive"/>
        @endif


        {{--    @if($orderby)--}}
        {{--      <x-admin.form.select-arr label="{{__('admin/config/settings.set_orderby')}}" name="{{$modelname}}_orderby" col="3"--}}
        {{--                               :send-arr="$OrderByArr"--}}
        {{--                               sendvalue="{{old($modelname.'_orderby',IsArr($modelSettings,$modelname.'_orderby',0))}}"--}}
        {{--                               select-type="normal"/>--}}
        {{--    @else--}}
        {{--      <input type="hidden" value="{{$orderbyDef}}" name="{{$modelname}}_orderby">--}}
        {{--    @endif--}}
        {{$slot}}
    </div>
    @if(isset($pageData['ModelId']))
        <input type="hidden" name="ModelId" value="{{$pageData['ModelId']}}">
    @endif

    <x-admin.form.submit-role-back :page-data="$pageData"/>
</form>
