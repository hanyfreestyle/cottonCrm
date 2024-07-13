<x-admin.card.normal :title="__('admin/Periodicals.app_menu_notes_add')">
    <form action="{{route('admin.Dashboard.filter')}}" method="post">
        @csrf
        <div class="row">
            <x-admin.form.select-arr name="periodicals_id" :sendvalue="old('periodicals_id',$_GET['p'] ?? null)" col="6" :send-arr="$Periodicals"
                                     label="{{__('admin/Periodicals.filter_periodicals')}}"/>
            <x-admin.form.input name="year" :value="old('year',$_GET['y'] ?? null)"  colrow="col-lg-2 col-4" :labelview="true" :label="__('admin/Periodicals.form_release_year')"/>
            <x-admin.form.input name="month" :value="old('month',$_GET['m'] ?? null)" colrow="col-lg-2 col-4" :labelview="true" :label="__('admin/Periodicals.form_release_month')"/>
            <x-admin.form.input name="number" :value="old('number',$_GET['n'] ?? null)" colrow="col-lg-2 col-4" :labelview="true" :label="__('admin/Periodicals.form_release_num')" :req="false"/>
        </div>
        <div class="row formFilterBut">
            <button type="submit" name="Forget" class="btn btn-dark btn-sm"><i class="fas fa-filter"></i> {{__('admin/form.button_serach')}}</button>
        </div>
    </form>

    @if($id)
        @if($releaseFilter)
            <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                    <th>{{__('admin/Periodicals.notes_release')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$releaseFilter->printReleaseName()}}</td>
                    <td class="td_action">
                        <x-admin.form.action-button url="{{route('admin.Periodicals.Notes.create',$releaseFilter->id)}}"
                                                    :print-lable="__('admin/Periodicals.but_filter_sel')" icon="fas fa-plus"/>
                    </td>
                </tr>
                </tbody>
            </table>
        @else
            <table class="mt-5 table table-striped table-valign-middle">
                <tr>
                    <td>{{__('admin/Periodicals.dash_err_not_found')}}</td>
                </tr>
            </table>
        @endif
    @endif
</x-admin.card.normal>
