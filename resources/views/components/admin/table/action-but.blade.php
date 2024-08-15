@if($po == 'top' and $viewBut == true)
    @if($type == 'empty')
        <th class="td_action {{$res}}"></th>
    @elseif($type == 'isActive')
        <th class="td_action {{$res}}"></th>
    @elseif($type == 'photo')
        <th class="td_action {{$res}}"></th>
    @elseif($type == 'edit')
        @can($PrefixRole.'_edit')
            <th class="td_action {{$res}}"></th>
        @endcan
    @elseif($type == 'add')
        @can($PrefixRole.'_add')
            <th class="td_action {{$res}}"></th>
        @endcan
    @elseif($type == 'addLang')
        @if(count(config('app.web_lang')) > 1 )
            @can($PrefixRole.'_edit')
                <th class="td_action {{$res}}"></th>
            @endcan
        @endif
    @elseif($type == 'delete')
        @can($PrefixRole.'_delete')
            <th class="td_action {{$res}}"></th>
        @endcan
    @elseif($type == 'deleteAll')
        @can($PrefixRole.'_delete')
            <th class="tdc {{$res}}"><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>
        @endcan
    @elseif($type == 'selectAll')
        <th class="td_action"><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>
    @endif
@elseif($po == 'button' and $viewBut == true)
    @if($type == 'edit')
        @can($PrefixRole.'_edit')
            @if($modelid)
                <td class="td_action">
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.edit',[$modelid,$row->id])}}" type="edit"/>
                </td>
            @else
                <td class="td_action">
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.edit',$row->id)}}" :tip="$agent->isDesktop()" type="edit"/>
                </td>
            @endif
        @endcan
    @elseif($type == 'addLang')
        @can($PrefixRole.'_edit')
            @if($modelid)
                <x-admin.lang.add-new-button :row="$row" :modelid="$modelid"/>
            @else
                <x-admin.lang.add-new-button :row="$row"/>
            @endif
        @endcan
    @elseif($type == 'Photos')
        @can($PrefixRole.'_edit')
            @if($modelid)
                <td class="td_action">
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',[$modelid,$row->id])}}" type="morePhoto" :count="$row->admin_more_photos_count"/>
                </td>
            @else
                <td class="td_action">
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$row->id)}}" type="morePhoto" :count="$row->admin_more_photos_count"/>
                </td>
            @endif
        @endcan
    @elseif($type == 'delete')
        @can($PrefixRole.'_delete')
            <td class="td_action">
                <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.destroy',$row->id)}}" :tip="$agent->isDesktop()" type="deleteSweet"/>
            </td>
        @endcan
    @elseif($type == 'liveDelete')
        @can($PrefixRole.'_delete')
            <td class="td_action">
                <x-admin.form.action-button url="#" id="{{$row->id}}" type="liveDelete"/>
            </td>
        @endcan
    @elseif($type == 'deleteAll')
        @can($PrefixRole.'_delete')
            <td class="tdc"><input type="checkbox" name="ids[]" value="{{$row->id}}" class=""></td>
        @endcan
    @elseif($type == 'password')
        @can($PrefixRole.'_edit')
            <td class="td_action">
                <x-admin.form.action-button url="{{route($PrefixRoute.'.Password',$row->id)}}" type="password"/>
            </td>
        @endcan
    @elseif($type == 'addTicket')
        @can($PrefixRole.'_add')
            <td class="td_action">
                <x-admin.form.action-button url="{{route($PrefixRoute.'.addTicket',$row->id)}}" :tip="$agent->isDesktop()" type="addTicket"/>
            </td>
        @endcan
    @elseif($type == 'profile')
        @can($PrefixRole.'_edit')
            <td class="td_action">
                <x-admin.form.action-button url="{{route($PrefixRoute.'.profile',$row->id)}}" :tip="$agent->isDesktop()" type="Profile"/>
            </td>
        @endcan
    @elseif($type == 'selectAll')
        <td class="td_action"><input class="selectAll_checkbox" type="checkbox" name="ids[]" @if(in_array($row->id, old('ids') ?? [])) checked @endif value="{{$row->id}}"></td>
    @endif

@endif
