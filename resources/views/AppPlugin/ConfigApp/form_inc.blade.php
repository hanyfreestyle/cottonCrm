<div class="row">
  @foreach ( config('app.web_lang') as $key=>$lang )
    <div class="col-lg-{{getColLang(6)}} {{getColDir($key)}}">
      <x-admin.form.trans-input :row="$menu" name="label" :label="__('admin/configApp.form_name')" :tdir="$key" :key="$key" col="12"/>
      <x-admin.form.trans-input :row="$menu" name="icon" :label="__('admin/configApp.form_icon')" :tdir="$key" :key="$key" col="12"/>
      <x-admin.form.trans-input :row="$menu" name="url" :label="__('admin/configApp.form_url')" :tdir="$key" :key="$key" col="12"/>
    </div>
  @endforeach
</div>

<hr>
<x-admin.form.check-active :row="$menu" :lable="__('admin/def.status')" name="is_active" page-view="{{$pageData['ViewType']}}"/>
<hr>
