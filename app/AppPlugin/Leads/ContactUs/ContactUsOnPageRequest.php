<?php

namespace App\AppPlugin\Leads\ContactUs;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactUsOnPageRequest extends FormRequest {

  public function authorize(): bool {
    return true;
  }


  public function rules(Request $request): array {
    $form_id = $request->input('form_id');
    $countryCode = strtoupper($request->input('countryCode_' . $form_id));

    $rules = [
      'name' . $form_id => "required|min:4|max:50",
      'phone' . $form_id => "required|numeric|phone:mobile,$countryCode",
    ];
    return $rules;
  }


}
