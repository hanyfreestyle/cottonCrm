@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>

        @can($PrefixRole."_export")
            <x-admin.main.filter-form form-name="{{$formName}}" :row="$rowData" :country="true" :project="false" />
        @endcan

        <x-admin.card.def :page-data="$pageData">
            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        <thead>
                        <tr>
                            <th class="TD_120">{{__('admin/leadsContactUs.t_date_add')}}</th>
                            <th class="TD_200">{{__('admin/leadsContactUs.t_name')}}</th>
                            <th class="TD_20">{{__('admin/leadsContactUs.t_country')}}</th>

                            <th class="TD_150">{{__('admin/leadsContactUs.t_full_number')}}</th>
                            @if($requestType == 1 )
                                <th class="TD_200">{{__('admin/leadsContactUs.t_subject')}}</th>
                            @endif

                            @if($requestType == 3 )
                                <th class="TD_120">{{__('admin/leadsContactUs.t_meeting_date')}}</th>
                                <th class="TD_120">{{__('admin/leadsContactUs.t_meeting_time')}}</th>
                            @endif

                            @if($requestType == 2 or $requestType == 3)
                                <th class="TD_250">{{__('admin/leadsContactUs.t_listing')}}</th>
                            @endif
                            <th class="td_action"></th>
                            <x-admin.table.action-but po="top" type="delete"/>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->getFormatteDate()}}</td>
                                <td>{{$row->name}}</td>
                                <td class="leadsFlag">{!! TablePhotoFlag($row->countryName) !!}</td>
                                <td class="phone_number">{{$row->full_number}}</td>

                                @if($requestType == 1 )
                                    <td>{{$row->subject}}</td>
                                @endif

                                @if($requestType == 3 )
                                    <td>{{$row->getmeetingDate()}}</td>
                                    <td>{{$row->meeting_time}}</td>
                                @endif

                                @if($requestType == 2 or $requestType == 3)
                                    <td>{{$row->listinginfo->name ?? ''}}</td>
                                @endif

                                <td><button type="button" class="btn btn-default" data-toggle="modal"  data-target="#modal_{{$row->id}}"><i class="fas fa-eye"></i></button></td>
                                <x-admin.modal.lead-info  :id="$row->id" :row="$row" />

                                <x-admin.table.action-but type="delete" :row="$row" />
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata" />
            @endif
        </x-admin.card.def>
        <x-admin.hmtl.pages-link :row="$rowData" />
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="$viewDataTable" />
@endpush
