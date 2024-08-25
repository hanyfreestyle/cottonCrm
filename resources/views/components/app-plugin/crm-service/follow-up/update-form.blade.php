<div class="row">
    <div class="col-lg-12">
        <x-admin.form.print-error-div/>
    </div>

    <x-admin.card.normal col="col-lg-12">
        <form class="mainForm" action="{{route($PrefixRoute.'.UpdateTicketStatus',$ticket->id)}}" method="post">
            <input type="text" name="follow_state" value="{{$followState}}">
            @csrf


            <x-admin.form.submit-cancel :back-to="route($PrefixRoute.'.UpdateTicket',$ticket->id)"/>
        </form>
    </x-admin.card.normal>
</div>
