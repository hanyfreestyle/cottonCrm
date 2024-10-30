<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-12">
                <h1 class="def_breadcrumb_h1">
                    @if($butView)
                        <a href="{{route('admin.Dashboard')}}">
                            <i class="fa {{IsArr($pageData,'IconPage','fa-home')}}"></i>
                        </a>
                    @endif
                    {{$pageData['TitlePage']}}
                </h1>
            </div>
            @if($newView)
                <div class="col-lg-6 col-12">
                     {{$slot}}
                </div>
            @else
                <div class="col-lg-6 col-12">
                    <ol class="breadcrumb float-sm-right text-md">
                        @if ($pageData['ViewType'] == 'List')
                        @else
                            @if(isset($pageData['PageListUrl']))
                                <x-admin.form.action-button :url="$pageData['PageListUrl']" :l="$pageData['ListPageName']" icon="fas fa-search" size="s" bg="p" :tip="$agent->isMobile()"/>
                            @endif
                        @endif
                    </ol>
                </div>
            @endif

        </div>
    </div>
</section>
