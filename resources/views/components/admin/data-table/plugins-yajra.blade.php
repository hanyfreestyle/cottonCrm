@if($style)
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/datatables-responsive/css/responsive.bootstrap4.css',$minType,$reBuild) !!}
    {!! $MinifyTools->setAdmin()->MinifyCss('plugins/datatables-buttons/css/buttons.bootstrap4.min.css',$minType,$reBuild) !!}
@endif

@if($jscode)
    <script src="{{defAdminAssets('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{defAdminAssets('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{defAdminAssets('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{defAdminAssets('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
@endif

