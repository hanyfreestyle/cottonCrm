@if($type)
    <x-admin.form.select-arr name="user_id" :send-arr="$row" :label="$label" :req="$req" :col="$col" :labelview="$labelview" :col-mobile="$colMobile" />
@endif
