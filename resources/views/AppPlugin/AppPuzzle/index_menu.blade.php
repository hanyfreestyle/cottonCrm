<div class="col-lg-12 mb-3">
    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Config.IndexModel')}}" :tip="false" icon="fas fa-cogs"
                                size="m" size="m" print-lable="Config" :bg="puzzleMenu('Config',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Data.IndexModel')}}" :tip="false" icon="fas fa-database"
                                size="m" print-lable="Data" :bg="puzzleMenu('Data',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Model.IndexModel')}}" :tip="false" icon="fas fa-puzzle-piece"
                                size="m" print-lable="Model" :bg="puzzleMenu('Model',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Product.IndexModel')}}" :tip="false" icon="fas fa-shopping-cart"
                                size="m" print-lable="Product" :bg="puzzleMenu('Product',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Crm.IndexModel')}}" :tip="false" icon="fas fa-headset"
                                size="m" print-lable="Crm" :bg="puzzleMenu('Crm',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.crmService.IndexModel')}}" :tip="false" icon="fas fa-plug"
                                size="m" print-lable="CrmService" :bg="puzzleMenu('crmService',$selRoute)"/>

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Periodicals.IndexModel')}}" :tip="false" icon="fas fa-book"
                                size="m" print-lable="Periodicals" :bg="puzzleMenu('Periodicals',$selRoute)"/>


    <x-admin.form.action-button url="{{route('admin.AppPuzzle.AppCore.IndexModel')}}" :tip="false" icon="fas fa-warehouse"
                                size="m" print-lable="App Core" :bg="puzzleMenu('AppCore',$selRoute)"/>

{{--    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Tools.IndexModel')}}" :tip="false" icon="fas fa-tools"--}}
{{--                                size="m" print-lable="Tools" :bg="puzzleMenu('Tools',$selRoute)"/>--}}

    <x-admin.form.action-button url="{{route('admin.AppPuzzle.Client.IndexModel')}}" :tip="false" icon="fas fa-user-friends"
                                size="m" print-lable="Client" :bg="puzzleMenu('Client',$selRoute)"/>



</div>

