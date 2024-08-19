<div>
  <div class="widget widget_text">
    <div class="widget_footer newl_des_1">
      @if (session()->has('SaveToNewsLetter'))
        <div class="newsletter_confirm">
          {{ session('SaveToNewsLetter') }}
        </div>
      @else
        <p class="text-center">{!! __('web/newsletter.text') !!}</p>
        <form wire:submit.prevent="addNew" class="mc4wp-form pr z_100">
          <div class="mc4wp-form-fields">
            <div class="signup-newsletter-form row no-gutters pr oh ">
              <div class="col col_email">
                <input type="text" wire:model="email" placeholder="{{__('web/newsletter.email')}}" class="tc tl_md input-text">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn_new_icon_false w__100 submit-btn truncate">
                  <span>{{__('web/newsletter.subscribe')}}</span>
                </button>
              </div>
            </div>
          </div>
        </form>
        <div class="newsletter_error">
          @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>
      @endif
      <div class="nt-social text-center mt__20">
        @if($WebConfig->facebook)
          <a href="{{$WebConfig->facebook}}" class="facebook cb ttip_nt tooltip_top">
            <span class="tt_txt">Follow on Facebook</span><i class="facl facl-facebook"></i>
          </a>
        @endif
        @if($WebConfig->twitter)
          <a href="{{$WebConfig->twitter}}" class="twitter cb ttip_nt tooltip_top">
            <span class="tt_txt">Follow on Twitter</span><i class="facl facl-twitter"></i>
          </a>
        @endif
        @if($WebConfig->instagram)
          <a href="{{$WebConfig->instagram}}" class="instagram cb ttip_nt tooltip_top">
            <span class="tt_txt">Follow on Instagram</span><i class="facl facl-instagram"></i>
          </a>
        @endif
        @if($WebConfig->pinterest)
          <a href="{{$WebConfig->pinterest}}" class="pinterest cb ttip_nt tooltip_top">
            <span class="tt_txt">Follow on Pinterest</span><i class="facl facl-pinterest"></i>
          </a>
        @endif
        @if($WebConfig->linkedin)
          <a href="{{$WebConfig->linkedin}}" class="linkedin cb ttip_nt tooltip_top">
            <span class="tt_txt">Follow on Linkedin</span><i class="facl facl-linkedin"></i>
          </a>
        @endif
      </div>
    </div>

  </div>
</div>
