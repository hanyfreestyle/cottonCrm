@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <div class="col-lg-12 dir_button mb-3">
            @can($PrefixRole.'_add')
                <x-admin.form.action-button url="{{route($PrefixRoute.'.create')}}" type="add" size="m" :tip="false"/>
            @endcan
            @can($PrefixRole.'_edit')
                <x-admin.form.action-button url="{{route($PrefixRoute.'.sortDefPhotoList')}}" type="sort" size="m" :tip="false"/>
            @endcan
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.hmtl.confirm-massage/>
        @if(count($rowData)>0)
            <div class="row col-lg-12 hanySort">
                @foreach($rowData as $row)
                    <div class="col-lg-3 ListThisItam" data-index="{{$row->id}}" data-position="{{$row->postion}}">
                        <div class="card card-primary card-outline">
                            <div class="card-header"><h5 class="card-title m-0">{{$row->cat_id}}</h5></div>
                            <div class="card-body">
                                <p class="PhotoImageCard"><img src="{{defImagesDir($row->photo)}}"></p>
                                <hr>
                                <div class="row">
                                    @can($PrefixRole.'_edit')
                                        <span class="ml-2">
                                            <x-admin.form.action-button url="{{route($PrefixRoute.'.edit',$row->id)}}" type="edit" :tip="false" size="s"/>
                                            </span>
                                    @endcan

                                    @can($PrefixRole.'_delete')
                                        <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.destroy',$row->id)}}" type="deleteSweet" :tip="false"/>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="col-lg-12">
                <x-admin.hmtl.alert-massage type="nodata"/>
            </div>
        @endif

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
@endpush
