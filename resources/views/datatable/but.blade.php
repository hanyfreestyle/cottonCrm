@if($btype == 'Edit')
    <x-admin.form.action-button url='{{route($PrefixRoute.".edit",$row->id)}}' type='edit' :tip="false"/>
@elseif($btype == 'Profile')
    <x-admin.form.action-button url='{{route($PrefixRoute.".profile",$row->id)}}' type='Profile' :tip="false"/>
@elseif($btype == 'viewTicket')
    <x-admin.form.action-button url='{{route($PrefixRoute.".viewTicket",$row->id)}}' type='viewTicket' :tip="false"/>
@elseif($btype == 'addTicket')
    <x-admin.form.action-button url='{{route($PrefixRoute.".addTicket",$row->id)}}' type='addTicket' :tip="false"/>



@elseif($btype == 'changeUser')
            <button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modal_user_{{$row->id}}'>
                <i class="fas fa-people-arrows"></i></button>
            <x-app-plugin.crm.leads.popup-chaneg-user :id="$row->id"   :config="$Config" :row="$row"/>
{{--            <x-admin.form.action-button url='{{route($PrefixRoute.".changeUser",$row->id)}}' type='changeUser' :tip="false"/>--}}
{{--    @if($agent->isDesktop())--}}
{{--        <x-admin.form.action-button url='{{route($PrefixRoute.".changeUser",$row->id)}}' type='changeUser' :tip="false"/>--}}
{{--        <button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modal_user_{{$row->id}}'>--}}
{{--            <i class="fas fa-people-arrows"></i> <span class="tipName"> {{__('admin/crm/ticket.fr_change_but')}}</span></button>--}}
{{--        <x-app-plugin.crm.leads.popup-chaneg-user :id="$row->id" :config="$Config" :row="$row"/>--}}
{{--    @else--}}
{{--        <button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modal_user_{{$row->id}}'>--}}
{{--            <i class="fas fa-people-arrows"></i> <span class="tipName"> {{__('admin/crm/ticket.fr_change_but')}}</span></button>--}}
{{--        <x-app-plugin.crm.leads.popup-chaneg-user :id="$row->id" :config="$Config" :row="$row"/>--}}
{{--        <x-admin.form.action-button url='{{route($PrefixRoute.".changeUser",$row->id)}}' type='changeUser' :tip="false"/>--}}
{{--    @endif--}}


@elseif($btype == 'AddRelease')
    <x-admin.form.action-button url='{{route($PrefixRoute.".AddRelease",$row->id)}}' type='AddRelease' :tip="false"/>
@elseif($btype == 'ListRelease')
    <x-admin.form.action-button url='{{route($PrefixRoute.".ListRelease",$row->id)}}' type='ListRelease' :tip="false"/>
@elseif($btype == 'is_active_update')
    <x-admin.ajax.update-status-but :row="$row"/>
@elseif($btype == 'MorePhoto')
    <x-admin.form.action-button url='{{route($PrefixRoute.".More_Photos",$row->id)}}' type='morePhoto'/>
@elseif($btype == 'Delete')
    <a href="#" id="{{route($PrefixRoute.'.destroy',$row->id)}}" onclick="sweet_dalete(this.id)" class="edit btn btn-danger btn-sm adminButMobile">
        <i class="fas fa-trash"></i> <span class="tipName"> {{__('admin/form.button_delete')}}</span></a>
@elseif($btype == 'viewInfo')
<button type='button' class='btn btn-sm btn-dark' data-toggle='modal' data-target='#modal_{{$row->id}}'><i class="fas fa-eye"></i></button>
<x-app-plugin.crm.leads.popup-lead-info :id="$row->id" :config="$Config" :row="$row"/>

@elseif($btype == 'addLang')
    @if(!isset($row->translate('ar')->name))
        <x-admin.form.action-button url="{{route($PrefixRoute.'.editAr',$row->id)}}" icon="fa-solid fa-globe" :tip="true"
                                    print-lable="{{__('admin.multiple_lang_menu_ar')}}"/>
    @elseif(!isset($row->translate('en')->name))
        <x-admin.form.action-button url="{{route($PrefixRoute.'.editEn',$row->id)}}" icon="fa-solid fa-globe" :tip="true"
                                    print-lable="{{__('admin.multiple_lang_menu_en')}}"/>
    @endif

@elseif($btype == 'CatName')
    @if($Config['TableCategory'])
        @foreach($row->categories as $Category )
            <a href="{{route($PrefixRoute.'.ListCategory',$Category->id)}}">
                <span class="cat_table_name">{{ print_h1($Category)}}</span>
            </a>
        @endforeach
    @endif
@elseif($btype == 'TagsName')
    @foreach($row->tags as $tag )
        <span class="cat_table_name">{{$tag->name}}</span>
    @endforeach
@elseif($btype == 'CatNameNoSlug')
    @if($Config['TableCategory'])
        @foreach($row->categories as $Category )
            <span class="cat_table_name">{{ print_h1($Category)}}</span>
        @endforeach
    @endif
@elseif($btype == 'Password')
    <x-admin.form.action-button url="{{route($PrefixRoute.'.Password',$row->id)}}" type="password"/>
@elseif($btype == 'ViewListing')
    <x-admin.form.action-button url="{{route('page_ListView',$row->slug)}}" bg="dark" icon="fa fa-eye" :target="true"/>
@elseif($btype == 'Restore')
    @can($PrefixRole.'_restore')
        <x-admin.form.action-button url="{{route($PrefixRoute.'.restore',$row->id)}}" type="restor" :tip="true"/>
    @endcan
@elseif($btype == 'ForceDelete')
    @can($PrefixRole.'_restore')
        <a href="#" id="{{route($PrefixRoute.'.force',$row->id)}}" onclick="sweet_dalete(this.id)" class="edit btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
    @endcan
@endif






