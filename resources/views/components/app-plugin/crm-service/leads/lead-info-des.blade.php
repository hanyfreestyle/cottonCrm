<div class="row mt-3">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title" style="color: #fff!important;">{{__('admin/crm.model_title_info')}}</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped text-nowrap">
                    <thead>
                    <tr>
                        <th>{{__('admin/crm.label_date_add')}}</th>
                        <th>{{__('admin/crm.label_date_follow')}}</th>
                        <th>{{__('admin/crm.label_state')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($row as $des)
                        <tr>
                            <td data-th="{{__('admin/crm.label_date_add')}}"> {{ PrintDate($des->created_at, 'Y-m-d H:i')}}</td>
                            <td data-th="{{__('admin/crm.label_date_follow')}}"> {{PrintDate($des->follow_date)}}</td>
                            <td data-th="{{__('admin/crm.label_state')}}"> {{ getDataFromDefCat($DefCat['CrmServiceTicketState'],$des->follow_state)}}</td>
                            <td> {{$des->des ?? ''}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
