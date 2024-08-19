@if($isactive)
    <div class="d-flex justify-content-center">
        @if($viewDataTable ?? false == false)
            {{ $row->links() }}
        @endif
    </div>
@endif
