<?php

namespace App\AppPlugin\Crm\CrmService\FollowUp\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateTicketStatusRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {

//        dd($request->follow_state);

        $rules = [
            'name' => 'required'
        ];

        $rules += [

        ];

        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
