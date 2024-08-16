@if($type == 'edit')
    @can($PrefixRole.'_edit')
        {data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center actionButView"},
    @endcan
@elseif($type == 'delete')
    @if($view)
        @can($PrefixRole.'_delete')
            {data: 'Delete', name: 'Delete', orderable: false, searchable: false, className: "text-center actionButView"},
        @endcan
    @endif
@elseif($type == 'photo')
    @if($view)

        @if(IsArr($modelSettings,$controllerName."_view_photo",0))
            {data: 'photo', name: 'photo', orderable: false, searchable: false, className: "text-center"},
        @endif
    @endif
@elseif($type == 'isActive')
    {data: 'isActive', name: 'isActive', orderable: false, searchable: false, className: "text-center"},

@endif

