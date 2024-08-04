@if($style)
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin/')->MinifyCss('plugins/datatables-responsive/css/responsive.bootstrap4.css','Seo',true) !!}
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endif


@if($jscode)
    <script src="{{defAdminAssets('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{defAdminAssets('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{defAdminAssets('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{defAdminAssets('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
@endif

