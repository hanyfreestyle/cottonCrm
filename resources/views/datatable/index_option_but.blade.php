@can($PrefixRole."_".IsArr($arr,'can','view'))
    @if(IsArr($config,IsArr($arr,'db',null),1))
        @if(IsArr($modelSettings,$controllerName."_".IsArr($arr,'config',null),1))
            {data: "{{$d}}", name: '{{$dn}}', orderable: {{IsArr($arr,'o',true)}}, searchable: {{IsArr($arr,'s',true)}}, className: "{{IsArr($arr,'c',null)}}"},
        @endif
    @endif
@endcan
