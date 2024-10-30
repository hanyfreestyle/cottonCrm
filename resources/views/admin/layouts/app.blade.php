<!DOCTYPE html>
<html lang="en" {!!htmlArDir()!!} >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('adminConfig.title')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(config('adminConfig.pace_progress') == true and config('adminConfig.preloader') == false)
        {!! $MinifyTools->setAdmin()->MinifyCss('plugins/pace-progress/themes/black/pace-theme-flat-top.css',$minType,$reBuild) !!}
    @endif
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/fontawesome-free/css/all.min.css',"Web",$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/flag-icon-css/css/flag-icon.min.css',"Web",$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/daterangepicker/daterangepicker.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/icheck-bootstrap/icheck-bootstrap.min.css',"Web",$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',"Web",$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/select2/css/select2.min.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/bs-stepper/css/bs-stepper.min.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/dropzone/min/dropzone.min.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/sweet/sweetalert2.min.css',$minType,$reBuild) !!}
    @yield('StyleFile')
    @if( thisCurrentLocale() == 'ar')
        {!! $MinifyTools->setAdmin()->MinifyCss('css/adminlte.css',$minType,$reBuild) !!}
    @elseif( thisCurrentLocale() == 'en')
        <link rel="stylesheet" href="{{ defAdminAssets('css/adminlte.css') }}">
    @endif
{{--    {!! $MinifyTools->setAdmin()->MinifyCss('css/adminlte.css',$minType,$reBuild) !!}--}}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/custom_admin.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/_def.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/card.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/form.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/product.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/chart.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/dataTable.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/table.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/infoDive.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/popupModal.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/user_follow.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/user_profile.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('css/html/responsive.css',$minType,$reBuild) !!}

    @if( thisCurrentLocale() == 'ar')
        {!! $MinifyTools->setAdmin()->MinifyCss('rtl/css/adminlte-rtl.css',$minType,$reBuild) !!}
        {!! $MinifyTools->setAdmin()->MinifyCss('rtl/css/custom.css',$minType,$reBuild) !!}
        {!! $MinifyTools->setAdmin()->MinifyCss('css/custom_ar.css',$minType,$reBuild) !!}
    @elseif( thisCurrentLocale() == 'en')
        {!! $MinifyTools->setAdmin()->MinifyCss('css/custom_en.css',$minType,$reBuild) !!}
    @endif
    {!! $MinifyTools->setAdmin()->MinifyCss('css/updateCss.css',$minType,$reBuild) !!}
</head>

<body class="hold-transition {{ mainBodyStyle() }} {{sidebarCollapse()}} ">
<div class="wrapper">


    @include('admin.layouts.inc.top_navbar')

    @include('admin.layouts.inc.sidebar')

    <div class="content-wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>


    @if(config('adminConfig.top_navbar_control') == true)
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
    @endif

    @if($agent->isDesktop())
        @include('admin.layouts.inc.footer')
    @endif
</div>

<script src="{{defAdminAssets('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

@yield('JsFileBeforeAdminlte')

<script src="{{defAdminAssets('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/moment/moment.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{defAdminAssets('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/sweet/sweetalert2.all.min.js')}}"></script>


<script src="{{defAdminAssets('js/adminlte.min.js')}}"></script>
<script src="{{defAdminAssets('parsley/parsley.js')}}"></script>
<script src="{{defAdminAssets('js/custom_file.js') }}"></script>
@if(config('adminConfig.pace_progress') == '1' and config('adminConfig.preloader') == false)
    <script src="{{ defAdminAssets('plugins/pace-progress/pace.min.js') }}"></script>
@endif
@yield('AddScript')
@stack('JsCode')
<script>
    async function loadarfont() {
        const font_ar = new FontFace('Tajawal', 'url({{ defAdminAssets('fonts/Ar/TajawalRegular.woff2') }}');
        await font_ar.load();
        document.fonts.add(font_ar);
        document.body.classList.add('Tajawal');
    };
    loadarfont();

    async function loadarfont_en() {
        const font_en = new FontFace('Poppins', 'url({{ defAdminAssets('fonts/En/Poppins-Regular.woff2') }}');
        await font_en.load();
        document.fonts.add(font_en);
        document.body.classList.add('Poppins');
    };
    loadarfont_en();
</script>
</body>
</html>
