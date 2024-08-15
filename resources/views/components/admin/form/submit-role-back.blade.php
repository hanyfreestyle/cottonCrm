<div class="row mt-3 mb-3">
    <div class="col-lg-12">
        @if($pageData['ViewType']  == 'Add')
            <button type="{{$type}}" name="{{$name}}" class="btn {{$size}} {{$buttonBackGround}} {{$dir}} adminButMobile">
                <i class="fas fa-plus-circle"></i> {{$text}}</button>
        @endif

        @if($pageData['ViewType']  == 'Edit')
            <button type="{{$type}}" name="{{$name}}" class="btn {{$size}} {{$buttonBackGround}} {{$dir}} adminButMobile">
                <i class="fas fa-pencil-ruler"></i> {{$text}}</button>
        @endif

        @if($pageData['ViewType']  == 'Add' and $addNew == true )
            <button type="{{$type}}" name="AddNewSet" value="1"
                    class="btn mr-3 ml-3 {{$size}} bg-dark {{$dir}} adminButMobile">
                <i class="fas fa-retweet"></i> {!! __('admin/form.button_add_anther') !!}</button>

        @elseif($pageData['ViewType']  == 'Edit' and $addNew == true )
            <button type="{{$type}}" name="GoBack" value="1"
                    class="btn mr-3 ml-3 {{$size}} bg-dark {{$dir}} adminButMobile">
                <i class="fas fa-retweet"></i> {!! __('admin/form.button_edit_back') !!} </button>
        @endif



    </div>
</div>

