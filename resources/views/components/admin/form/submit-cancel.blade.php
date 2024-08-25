<div class="row mb-3 mt-3">
    <div class="col-lg-12 float-left text-left">
        <div class="row">
            <div class="col-lg-12">
                <button type="submit" name="update" class="btn btn-primary adminButMobile">
                    <i class="far fa-check-square"></i> {{ __('admin/def.form_button_update')}}
                </button>

                <x-admin.form.action-button :l="__('admin/def.form_button_cancel')" bg="w" icon="fas fa-undo"
                                            url="{{$backTo}}" :tip="false" size="m"/>
            </div>
        </div>
    </div>
</div>
