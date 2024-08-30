<?php

namespace App\AppPlugin\Crm\CrmService\Leads\Request;

use App\AppPlugin\Crm\CrmService\Leads\Traits\CrmLeadsConfigTraits;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateTicketRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {
        $Config = CrmLeadsConfigTraits::defConfig();

        $rules = [
            'follow_date' => "required|date_format:Y-m-d|after_or_equal:today",
            'notes_err' => "required",
            'open_type' => "required",
        ];

        if (IsConfig($Config, 'leads_sours_id')) {
            $rules += ['sours_id' => 'required'];
        }
        if (IsConfig($Config, 'leads_ads_id')) {
            $rules += ['ads_id' => 'required'];
        }
        if (IsConfig($Config, 'leads_device_id')) {
            $rules += ['device_id' => 'required'];
        }
        if (IsConfig($Config, 'leads_brand_id')) {
            $rules += ['brand_id' => 'required'];
        }


        $rules += [

        ];

        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
