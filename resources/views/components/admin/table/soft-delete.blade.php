@if($type == 't')
    <th class="">{{ __('admin/def.delete_date') }}</th>
    <th class="td_action"></th>
    <th class="td_action"></th>

@elseif($type == 'b')
    <td>{{$row->deleted_at}}</td>
    <td><x-admin.form.action-button url="{{route($PrefixRoute.'.restore',$row->id)}}" type="restor" :tip="false"/></td>
    <td><x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.force',$row->id)}}" type="force" :tip="false"/></td>
@endif
