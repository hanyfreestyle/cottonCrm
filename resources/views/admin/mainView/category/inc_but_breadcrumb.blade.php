@if(IsConfig($config, 'categoryTree'))
    <ol class="breadcrumb breadcrumb_menutree">
        <li class="breadcrumb-item"><a href="{{route($PrefixRoute.'.index_Main')}}">{{__('admin/def.category_main')}}</a></li>
        @if($pageData['SubView'])
            @foreach($trees as $tree)
                <li class="breadcrumb-item"><a href="{{route($PrefixRoute.'.SubCategory',$tree->id)}}">{{ $tree->name }}</a></li>
            @endforeach
        @endif
    </ol>
@endif
