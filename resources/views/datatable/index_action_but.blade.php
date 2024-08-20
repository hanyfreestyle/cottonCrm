@if($type == 'edit')
    @can($PrefixRole.'_edit')
        {data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center actionButView"},
    @endcan
@elseif($type == 'Profile')
    @can($PrefixRole.'_edit')
        {data: 'Profile', name: 'Profile', orderable: false, searchable: false, className: "text-center actionButView"},
    @endcan
@elseif($type == 'delete')
    @if($view)
        @can($PrefixRole.'_delete')
            {data: 'Delete', name: 'Delete', orderable: false, searchable: false, className: "text-center actionButView"},
        @endcan
    @endif
@elseif($type == 'Restore')
    @can($PrefixRole.'_restore')
        {data: 'Restore', name: 'Restore', orderable: false, searchable: false, className: "text-center actionButView"},
    @endcan
@elseif($type == 'ForceDelete')
    @can($PrefixRole.'_restore')
        {data: 'ForceDelete', name: 'ForceDelete', orderable: false, searchable: false, className: "text-center actionButView"},
    @endcan
@elseif($type == 'photo')
    @if($view)
        @if(IsArr($modelSettings,$controllerName."_view_photo",0))
            {data: 'photo', name: 'photo', orderable: false, searchable: false, className: "text-center"},
        @endif
    @endif
@elseif($type == 'Flag')
    @if($view)
        {data: 'Flag', name: 'Flag', orderable: false, searchable: false, className: "text-center flag_icon"},
    @endif
@elseif($type == 'morePhoto')
    @if(IsArr($modelSettings,$controllerName."_morePhoto",0))
        {data: 'morePhoto', name: 'morePhoto', orderable: false, searchable: false, className: "text-center actionButView"},
    @endif
@elseif($type == 'isActive')
    {data: 'isActive', name: 'isActive', orderable: false, searchable: false, className: "text-center"},
@elseif($type == 'PublishedDate')
    @if($view)
        @if(IsArr($modelSettings,$controllerName."_dataTableDate",0))
            {'name': 'published_at','data': {'_': 'published_at.display','sort': 'published_at.timestamp'}},
        @endif
    @endif
@elseif($type == 'deleted_at')
    @if($view)
        {'name': 'deleted_at','data': {'_': 'deleted_at.display','sort': 'deleted_at.timestamp'}},
    @endif
@elseif($type == 'CategoryName')
    {data: 'CategoryName', name: 'category_names', orderable: false, searchable: false},
@elseif($type == 'UserName')
    @if($view)
        @if(IsArr($modelSettings,$controllerName."_dataTableUserName",0))
            {data: 'UserName', name: 'users.name', orderable: false, searchable: false},
        @endif
    @endif
@elseif($type == 'can')
    @can($can)
        {data: '{{$data}}', name: '{{$data}}', orderable: false, searchable: false, className: "text-center actionButView"},
    @endcan
@elseif($type == 'option')
    @if($option)
        {data: '{{$data}}', name: '{{$data}}', orderable: false, searchable: false, className: "text-center"},
    @endif
@endif


