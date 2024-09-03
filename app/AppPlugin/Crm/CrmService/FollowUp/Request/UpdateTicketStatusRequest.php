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

        if ($followState == 2 and $request->ticket_follow_state == 3) {
            $rules += [
                'amount' => 'required|numeric|gt:cash_amount'
            ];
        } elseif ($followState == 2) {
            $rules += [
                'amount' => 'required|numeric|min:1'
            ];
        }

        if ($followState == 3) {
            $rules += [
                'follow_date' => "required|date_format:Y-m-d|after_or_equal:today",
                'amount' => 'required|numeric|min:0'
            ];
        }

        if ($followState == 4) {
            $rules += [
                'follow_date' => "required|date_format:Y-m-d|after_or_equal:today",
            ];
        }

        if ($followState == 6) {
            $rules += [
                'amount' => 'required|numeric|min:0'
            ];
        }


        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
