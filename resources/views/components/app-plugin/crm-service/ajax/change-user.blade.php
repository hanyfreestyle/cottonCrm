<x-admin.hmtl.popup-modal id="{{$id}}" :title="$title">
    <div id="loading_spinner_user" style="display: none; text-align: center;">
        <div class="spinner-border" role="status">
            <span class="sr-only">{{__('admin/def.ajax_loading')}}</span>
        </div>
    </div>
    <div id="ticket_change_user"></div>
</x-admin.hmtl.popup-modal>

<script type="text/javascript">
    function onClickChangeUserAJAX(ticketId) {
        $('#loading_spinner_user').show();
        $('#ticket_change_user').hide();
        $.ajax({
            url: '{{ route($route, ['id' => ':id']) }}'.replace(':id', ticketId),
            type: 'GET',
            success: function (data) {
                $('#loading_spinner_user').hide();
                $('#ticket_change_user').html(data).show(); // عرض المحتوى الجديد
            },
            error: function (xhr, status, error) {
                console.error('حدث خطأ: ' + error);
                $('#loading_spinner_user').hide();
                $('#ticket_change_user').html('<p>{{__('admin/def.ajax_loading_err')}}</p>').show();
            }
        });
    }
</script>
