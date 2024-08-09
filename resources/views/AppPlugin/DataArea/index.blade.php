@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-admin.filter-card.country form-name="{{$formName}}" :row="$rowData" :country-id="true"/>
    </x-admin.hmtl.section>


    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="all">#</th>
                    @if($AppPluginConfig['add_country'] and File::isFile(base_path('routes/AppPlugin/data/country.php')))
                        <th class="desktop">{{__('admin/dataArea.form_country')}}</th>
                    @endif
                    @if($AppPluginConfig['add_city'] and File::isFile(base_path('routes/AppPlugin/data/city.php')))
                        <th class="all">{{__('admin/dataArea.form_city')}}</th>
                    @endif
                    <th class="all">{{__('admin/form.text_name')}}</th>

                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="edit"/>
                    @if($AppPluginConfig['deleteData'])
                        <x-admin.table.action-but po="top" type="delete"/>
                    @endif
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.data-table.sweet-dalete/>
    <x-admin.data-table.plugins-yajra :jscode="true"/>
    <script type="text/javascript">
        $(function () {
            $('#YajraDatatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 10,
                order: [0, 'desc'],
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",

                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                    {data: 'country_name', name: 'data_country_translations.name', orderable: true},
                    {data: 'city_name', name: 'data_city_translations.name', orderable: true},
                    {data: 'name', name: 'data_area_translations.name', orderable: true},
                        @can($PrefixRole.'_edit')
                    {
                        data: 'is_active', name: 'is_active', orderable: false, searchable: false, className: "text-center actionButView"
                    },
                    {data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center actionButView"},
                        @endcan

                        @can($PrefixRole.'_delete')
                        @if($AppPluginConfig['deleteData'])
                    {
                        data: 'Delete', name: 'Delete', orderable: false, searchable: false, className: "text-center actionButView"
                    },
                    @endif
                    @endcan
                ],

            });
        });
    </script>
@endpush
