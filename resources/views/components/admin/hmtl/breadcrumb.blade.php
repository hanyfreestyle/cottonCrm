<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-9">
                <h1 class="def_breadcrumb_h1">
                    @if($butView)
                        <a href="{{route('admin.Dashboard')}}">
                            <i class="fa {{IsArr($pageData,'IconPage','fa-home')}}"></i>
                        </a>
                    @endif
                    {{$pageData['TitlePage']}}
                </h1>
            </div>
            <div class="col-lg-3 col-3">
                <ol class="breadcrumb float-sm-right text-md">
                    @if ($pageData['ViewType'] == 'List')
                    @else
                        @if(isset($pageData['PageListUrl']))
                            <x-admin.form.action-button url="{{$pageData['PageListUrl']}}" print-lable="{{$pageData['ListPageName']}}" icon="fas fa-search" size="s" bg="p" :tip="$agent->isMobile()"/>
                        @endif
                    @endif
                </ol>
            </div>
        </div>
    </div>
</section>
