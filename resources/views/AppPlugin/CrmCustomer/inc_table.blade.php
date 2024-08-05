<div class="card-body table-responsive p-0">
    <table {!! Table_Style_Normal()  !!} >
        <thead>
        <tr>
            <th class="TD_20">#</th>
            <th class="TD_200">{{__($defLang.'form_name')}}</th>
            <th class="TD_100">{{__($defLang.'form_mobile')}}</th>
            <th class="TD_100">{{__($defLang.'form_mobile_2')}}</th>
            <th class="TD_100">{{__($defLang.'form_phone')}}</th>
            <th class="TD_100">{{__($defLang.'form_whatsapp')}}</th>
            @if($pageData['ViewType'] == 'LeadsSearch')
                <x-admin.table.action-but po="top" type="add"/>
            @else
                <x-admin.table.action-but po="top" type="edit"/>
                @if($pageData['ViewType'] == 'search')
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete"/>
                    @can('crm_leads_add')
                        <x-admin.table.action-but po="top" type="add"/>
                    @endcan

                @endif
            @endif


        </tr>
        </thead>
        <tbody>
        @foreach($rowData as $row)
            <tr>
                <td data-th="#">{{$row->id}}</td>
                <td data-th="{{__($defLang.'form_name')}}">{{$row->name}}</td>
                <td data-th="{{__($defLang.'form_mobile')}}">{{$row->mobile}}</td>
                <td data-th="{{__($defLang.'form_mobile_2')}}">{{$row->mobile_2}}</td>
                <td data-th="{{__($defLang.'form_phone')}}">{{$row->phone}}</td>
                <td data-th="{{__($defLang.'form_whatsapp')}}">{{$row->whatsapp}}</td>
                @if($pageData['ViewType'] == 'LeadsSearch')
                    <x-admin.table.action-but type="addTicket" :row="$row"/>
                @else
                    <x-admin.table.action-but type="edit" :row="$row"/>
                    @if($pageData['ViewType'] == 'search')
                        <x-admin.table.action-but type="profile" :row="$row"/>
                        <x-admin.table.action-but type="delete" :row="$row"/>
                        @can('crm_leads_add')
                            <x-admin.table.action-but type="addTicket" :row="$row"/>
                        @endcan

                    @endif
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
