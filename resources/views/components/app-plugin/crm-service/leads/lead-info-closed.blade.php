@if($row->state == 2)
    <div class="row mt-3">
        <div class="col-lg-3 col-6 text-center closed_lead_card">
            <div class="small-box {{$sendData['state_bg']}}">
                <div class="inner">
                    <h3><i class="{{$sendData['state_icon']}}"></i></h3>
                    <p>{{$sendData['state_text']}}</p>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-6 text-center closed_lead_card">
            <div class="small-box {{$sendData['time_bg']}}">
                <div class="inner">
                    <h3><i class="fas fa-history"></i></h3>
                    <p>{{ getDateDifference($row->created_at, $row->close_date) }}</p>
                </div>

            </div>
        </div>


        <div class="col-lg-3 col-6 text-center closed_lead_card">
            <div class="small-box {{$sendData['review_bg']}}">
                <div class="inner">
                    <h3><i class="fas fa-headset"></i></h3>
                    <p>{{$sendData['review_text']}}</p>
                </div>

            </div>
        </div>

        @if($row->customer_amount_sum_amount > 0 )
            <div class="col-lg-3 col-6">
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3>{{number_format($row->customer_amount_sum_amount)}}</h3>
                        <p>{{__('admin/crm_customer.profile_card_6')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endif
