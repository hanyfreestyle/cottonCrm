<?php

namespace App\AppPlugin\Config\Branche;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest {

  public function authorize(): bool {
    return true;
  }


  public function rules(): array {
    $rules = [
      'lat' => 'nullable|numeric',
      'long' => 'nullable|numeric',
      'direction' => 'nullable|url',

    ];

    foreach (config('app.web_lang') as $key => $lang) {
      $rules[$key . ".title"] = 'required';
      $rules[$key . ".address"] = 'required';
      $rules[$key . ".phone"] = 'required';
      $rules[$key . ".work_hours"] = 'nullable';
    }

    return $rules;
  }

}
