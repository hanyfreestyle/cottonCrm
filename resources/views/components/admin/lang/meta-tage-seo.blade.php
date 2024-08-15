@if($printType == 'Des')
    <div class="col-lg-12 mb-3">
        <div class="row">
            <x-admin.form.trans-input col="6" name="name" :key="$key" :row="$row" :label="$defName" :tdir="$key"/>
            @if($slug)
                @if($viewtype == 'Add' )
                    <x-admin.form.trans-input col="6" name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key"/>
                @elseif($viewtype == 'Edit')
                    @can($PrefixRole."_edit_slug")
                        <x-admin.form.trans-input col="6" name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key"/>
                    @else
                        <input type="hidden" name="{{ $key }}[slug]" value="{{$row->translate($key)->slug}}">
                    @endcan
                @endif
            @endif
            @if($des)
                <x-admin.form.trans-text-area name="des" :key="$key" :row="$row" :label="$defDes" :tdir="$key" add-class="bigTextArea"/>
            @endif
        </div>
    </div>
@endif

@if($printType == 'Seo')
    <div class="col-lg-12 mb-3">
        <div class="row">
            <x-admin.form.trans-input name="g_title" :key="$key" :row="$row" :label="__('admin/form.text_g_title')" :req="false" :tdir="$key"/>
            <x-admin.form.trans-text-area name="g_des" :key="$key" :row="$row" :label="__('admin/form.text_g_des')" :req="false" :tdir="$key"/>
        </div>
    </div>
@endif


