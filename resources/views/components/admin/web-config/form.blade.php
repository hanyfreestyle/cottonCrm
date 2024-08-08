@if($model == 'def')
    <x-admin.card.normal col="col-lg-12" title="{{__('admin/config/webConfig.app_menu')}}">
        <div class="row">
            @if(config('app.WEB_VIEW'))
                <div class="col-lg-7">
                    <div class="row">

                        <x-admin.form.select-arr name="web_status" :row="$row" :l="__('admin/config/webConfig.status_web')" col="4" type="selActive"/>
                        @if(count(config('app.web_lang')) > 1)
                            <x-admin.form.select-arr name="switch_lang" :row="$row" :l="__('admin/config/webConfig.web_switch_lang')" col="4" type="selActive"/>
                        @endif

                        @if(config('app.USER_LOGIN'))
                            <x-admin.form.select-arr name="users_login" :row="$row" :l="__('admin/config/webConfig.web_users_login')" col="4" type="selActive"/>
                        @endif

                        @foreach ( config('app.web_lang') as $key=>$lang )
                            <div class="col-lg-{{getColLang(6)}}">
                                <div class="row">
                                    <x-admin.form.trans-input name="name" :row="$row" :key="$key" :tdir="$key" :label="__('admin/config/webConfig.website_name')"/>
                                    <x-admin.form.trans-text-area name="closed_mass" :row="$row" :key="$key" :tdir="$key" :label="__('admin/config/webConfig.closed_mass')"/>
                                    <x-admin.form.trans-input name="meta_des" :row="$row" :key="$key" :tdir="$key" :label="__('admin/config/webConfig.meta_des')"/>
                                    <x-admin.form.trans-input name="whatsapp_des" :row="$row" :key="$key" :tdir="$key" :label="__('admin/config/webConfig.whatsapp_des')"/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="col-lg-5 ">
                <div class="row">
                    <x-admin.form.input :row="$row" name="phone_num" :label="__('admin/config/webConfig.phone')" colrow="col-lg-6 col-6" tdir="en"/>
                    <x-admin.form.input :row="$row" name="phone_call" :label="__('admin/config/webConfig.phone_call')" colrow="col-lg-6 col-6" tdir="en"/>
                    <x-admin.form.input :row="$row" name="whatsapp_num" :label="__('admin/config/webConfig.whatsapp')" colrow="col-lg-6 col-6" tdir="en"/>
                    <x-admin.form.input :row="$row" name="whatsapp_send" :label="__('admin/config/webConfig.whatsapp_send')" colrow="col-lg-6 col-6" tdir="en"/>
                </div>

                <div class="row">
                    <x-admin.form.input :row="$row" name="email" :label="__('admin/config/webConfig.email')" col="12" tdir="en"/>
                    <x-admin.form.input :row="$row" name="def_url" :label="__('admin/config/webConfig.def_url')" col="12" tdir="en"/>
                </div>

            </div>
        </div>
    </x-admin.card.normal>


@elseif($model == "product")
    @if(File::isFile(base_path('routes/AppPlugin/proProduct.php')))
        <x-admin.card.normal col="{{$col}}" title="{{__('admin/proProduct.web_setting_card')}}">


            <div class="row">


                <x-admin.form.select-arr name="serach" :sendvalue="old('serach',$row->serach)" :label="__('admin/config/webConfig.web_serach')"
                                         col="4" select-type="selActive"/>
                <x-admin.form.select-arr name="serach_type" :sendvalue="old('serach_type',$row->serach_type)"
                                         :label="__('admin/config/webConfig.web_serach_type')" col="4"
                                         :send-arr="$WebSearchTypeArr"/>
                <x-admin.form.select-arr name="wish_list" :sendvalue="old('wish_list',$row->wish_list)"
                                         :label="__('admin/config/webConfig.web_wish_list')" col="4"
                                         select-type="selActive"/>
            </div>


            <div class="row">
                <x-admin.form.select-arr name="page_about" :sendvalue="old('page_about',$row->page_about)"
                                         :label="__('admin/proProduct.web_page_about')" col="4" :send-arr="$pagesList"/>
                <x-admin.form.select-arr name="page_warranty" :sendvalue="old('page_warranty',$row->page_warranty)"
                                         :label="__('admin/proProduct.web_page_warranty')" col="4" :send-arr="$pagesList"/>
                <x-admin.form.select-arr name="page_shipping" :sendvalue="old('page_shipping',$row->page_shipping)"
                                         :label="__('admin/proProduct.web_page_shipping')" col="4" :send-arr="$pagesList"/>
                <x-admin.form.select-arr name="pro_sale_lable" :sendvalue="old('pro_sale_lable',$row->pro_sale_lable)"
                                         :label="__('admin/proProduct.web_sale_lable')" col="4" select-type="selActive"/>
                <x-admin.form.select-arr name="pro_quick_view" :sendvalue="old('pro_quick_view',$row->pro_quick_view)"
                                         :label="__('admin/proProduct.web_quick_view')" col="4" select-type="selActive"/>
                <x-admin.form.select-arr name="pro_quick_shop" :sendvalue="old('pro_quick_shop',$row->pro_quick_shop)"
                                         :label="__('admin/proProduct.web_quick_shop')" col="4" select-type="selActive"/>
                <x-admin.form.select-arr name="pro_warranty_tab" :sendvalue="old('pro_warranty_tab',$row->pro_warranty_tab)"
                                         :label="__('admin/proProduct.web_warranty_tab')" col="4"
                                         select-type="selActive"/>
                <x-admin.form.select-arr name="pro_shipping_tab" :sendvalue="old('pro_shipping_tab',$row->pro_shipping_tab)"
                                         :label="__('admin/proProduct.web_shipping_tab')" col="4"
                                         select-type="selActive"/>
                <x-admin.form.select-arr name="pro_social_share" :sendvalue="old('pro_social_share',$row->pro_social_share)"
                                         :label="__('admin/proProduct.web_social_share')" col="4"
                                         select-type="selActive"/>
            </div>
        </x-admin.card.normal>
    @endif
@elseif($model == "schema")
    @if(File::isFile(base_path('routes/AppPlugin/config/siteMaps.php')) and config('app.WEB_VIEW'))
        <x-admin.card.normal col="{{$col}}" title="Schema">
            <div class="row">
                <x-admin.form.input :row="$row" name="schema_type" label="Type" colrow="col-lg-4 col-6" tdir="en"/>
                <x-admin.form.input :row="$row" name="schema_lat" label="latitude" colrow="col-lg-4 col-6" tdir="en"/>
                <x-admin.form.input :row="$row" name="schema_long" label="longitude" colrow="col-lg-4 col-6" tdir="en"/>
                <x-admin.form.input :row="$row" name="schema_postal_code" label="postalCode" colrow="col-lg-4 col-6" tdir="en"/>
                <x-admin.form.input :row="$row" name="schema_country" label="addressCountry" colrow="col-lg-4 col-6" tdir="en"/>
            </div>
            <div class="row">
                @foreach ( config('app.web_lang') as $key=>$lang )
                    <div class="col-lg-{{getColLang(6)}}">
                        <x-admin.form.trans-input name="schema_address" add-class="col-lg-12 col-12" :row="$row" :key="$key" :tdir="$key" label="streetAddress"/>
                        <x-admin.form.trans-input name="schema_city" :row="$row" :key="$key" :tdir="$key" label="addressLocality"/>
                    </div>
                @endforeach
            </div>
        </x-admin.card.normal>
    @endif
@elseif($model == "social")
    @if(config('app.WEB_VIEW'))
        <x-admin.card.normal col="{{$col}}" title="{{__('admin/config/webConfig.social_media')}}">
            <div class="row">
                <x-admin.form.input :row="$row" name="facebook" label="Facebook" col="12" tdir="en"/>
                <x-admin.form.input :row="$row" name="youtube" label="Youtube" col="12" tdir="en"/>
                <x-admin.form.input :row="$row" name="twitter" label="Twitter" col="12" tdir="en"/>
                <x-admin.form.input :row="$row" name="instagram" label="Instagram" col="12" tdir="en"/>
                <x-admin.form.input :row="$row" name="linkedin" label="Linkedin" col="12" tdir="en"/>
                <x-admin.form.input :row="$row" name="google_api" label="Google Api" col="12" tdir="en"/>
            </div>
        </x-admin.card.normal>
    @endif


@elseif($model == "telegram")
    @if(config('app.CONFIG_TELEGRAM'))
        <x-admin.card.normal col="col-lg-6" title="Telegram">
            <div class="row">
                <x-admin.form.select-arr name="telegram_send" :sendvalue="old('telegram_send',$row->telegram_send)" label="Send" col="4"
                                         select-type="selActive"/>
                <x-admin.form.input :row="$row" name="telegram_key" label="Telegram Key" col="12" tdir="en"/>
                <x-admin.form.input :row="$row" name="telegram_phone" label="Telegram Group" colrow="col-lg-6 col-6" tdir="en"/>
                <x-admin.form.input :row="$row" name="telegram_group" label="Telegram Phone" colrow="col-lg-6 col-6" tdir="en"/>
            </div>
        </x-admin.card.normal>
    @endif

@elseif($model == "XXXXXXXXXXXXXXXXXXXXXXXXXXX")
@elseif($model == "XXXXXXXXXXXXXXXXXXXXXXXXXXX")
@endif
