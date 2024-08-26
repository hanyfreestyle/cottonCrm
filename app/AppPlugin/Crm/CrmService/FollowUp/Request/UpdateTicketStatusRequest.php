<?php

namespace App\AppPlugin\Crm\CrmService\FollowUp\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateTicketStatusRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {

        $followState = $request->follow_state;

        $rules = [
            'des' => 'required'
        ];

        if ($followState == 2) {
            $rules += [
                'cost' => 'required|numeric|min:0'
            ];
        }
        if ($followState == 3) {
            $rules += [
                'follow_date' => "required|date_format:Y-m-d|after_or_equal:today",
                'deposit' => 'required|numeric|min:0'
            ];
        }

        if ($followState == 4) {
            $rules += [
                'follow_date' => "required|date_format:Y-m-d|after_or_equal:today",
            ];
        }

        if ($followState == 6) {
            $rules += [
                'cost_service' => 'required|numeric|min:0'
            ];
        }



        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
