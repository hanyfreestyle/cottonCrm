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
            <x-admin.table.action-but po="top" type="edit"/>
            @if($pageData['ViewType'] == 'search')
                <x-admin.table.action-but po="top" type="edit"/>
                <x-admin.table.action-but po="top" type="delete"/>
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
                <x-admin.table.action-but type="edit" :row="$row"/>
                @if($pageData['ViewType'] == 'search')
                    <x-admin.table.action-but type="profile" :row="$row"/>
                    <x-admin.table.action-but type="delete" :row="$row"/>

                @endif

            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{--<div class="card-body table-responsive p-0">--}}
{{--    <table class="table table-hover rwd-table">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Movie Title</th>--}}
{{--            <th>Genre</th>--}}
{{--            <th>Year</th>--}}
{{--            <th>Gross</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td data-th="Movie Title">Star Wars</td>--}}
{{--            <td data-th="Genre">Adventure, Sci-fi</td>--}}
{{--            <td data-th="Year">1977</td>--}}
{{--            <td data-th="Gross">$460,935,665</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td data-th="Movie Title">Howard The Duck</td>--}}
{{--            <td data-th="Genre">"Comedy"</td>--}}
{{--            <td data-th="Year">1986</td>--}}
{{--            <td data-th="Gross">$16,295,774</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td data-th="Movie Title">American Graffiti</td>--}}
{{--            <td data-th="Genre">Comedy, Drama</td>--}}
{{--            <td data-th="Year">1973</td>--}}
{{--            <td data-th="Gross">$115,000,000</td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}

{{--    </table>--}}
{{--</div>--}}


