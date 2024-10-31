@can($PrefixRole."_".$can)
    @if(IsArr($config,$dbTable,1))
        @if(IsArr($modelSettings,$controllerName."_".$setName,1))
            <th class="{{$but}} {{$res}}">{{$l}}</th>
        @endif
    @endif
@endcan

