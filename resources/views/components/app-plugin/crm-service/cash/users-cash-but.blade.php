@if(intval($amount) != 0)
    <td>
        <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.ConfirmPay',$id)}}" :tip="false"
                                    sweet-del-class="sweet_confirm_but_{{$id}}"
                                    :l="__('admin/crm_service_cash.label_but_collection')" bg="s" icon="fas fa-vote-yea"/>
    </td>

@endif
@push('JsCode')
    <x-admin.table.sweet-confirm-js class-name="sweet_confirm_but_{{$id}}" icon-style="confirm_get_amount" s-text="{!! $mass !!}"/>
@endpush
