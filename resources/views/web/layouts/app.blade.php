<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="index, follow">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {!! SEO::generate() !!}
  <x-site.def.fav-icon/>
{{--  {!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/drift-basic.min.css',$cssMinifyType,$cssReBuild) !!}--}}


  @yield('AddStyle')
  @stack('StyleFile')

  @if(thisCurrentLocale() == 'ar')

  @endif

  @livewireStyles
</head>

<body class="{{htmlBodyStyle($pageView)}}">
@yield('content')
<a id="nt_backtop" class="pf br__50 z__100 des_bt2" href="#"><span class="tc br__50 db cw"><i class="pr pegk pe-7s-angle-up"></i></span></a>

{{--{!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/jquery-3.5.1.min.js',"Web",false) !!}--}}

@yield('TempScript')


<x-site.js.load-web-font/>
@livewireScripts
<script>
    document.addEventListener('livewire:load', () => {
        Livewire.onPageExpired((response, message) => {
        })
    })
</script>
@yield('AddScript')
@stack('ScriptCode')

</body>
</html>
