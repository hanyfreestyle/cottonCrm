<x-admin.hmtl.popup-modal id="{{$id}}" :title="$title">
    <div id="loading-spinner" style="display: none; text-align: center;">
        <div class="spinner-border" role="status">
            <span class="sr-only">{{__('admin/def.ajax_loading')}}</span>
        </div>
    </div>
    <div id="ticket_details"></div>
</x-admin.hmtl.popup-modal>

<script type="text/javascript">
    function onClickTicketInfoAJAX(ticketId) {
        $('#loading-spinner').show();
        $('#ticket_details').hide();
        $.ajax({
            url: '{{ route($route, ['id' => ':id']) }}'.replace(':id', ticketId),
            type: 'GET',
            success: function (data) {
                $('#loading-spinner').hide();
                $('#ticket_details').html(data).show(); // عرض المحتوى الجديد
            },
            error: function (xhr, status, error) {
                console.error('حدث خطأ: ' + error);
                $('#loading-spinner').hide();
                $('#ticket_details').html('<p>{{__('admin/def.ajax_loading_err')}}</p>').show();
            }
        });
    }
</script>
