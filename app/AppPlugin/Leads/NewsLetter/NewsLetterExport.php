<?php

namespace App\AppPlugin\Leads\NewsLetter;


use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class NewsLetterExport implements FromQuery, ShouldAutoSize, WithMapping, WithHeadings {
  use Exportable;

  protected $request;

  public function __construct($request) {
    $this->request = $request;
  }

  public function query() {
    $session = Session::get($this->request->input('formName'));
    $GetData = AdminMainController::FilterQ(NewsLetter::query(), $session, 'created_at|ASC');
    return $GetData;
  }

  public function map($GetData): array {

    return [
      $GetData->id,
      $GetData->email,
      Carbon::parse($GetData->created_at)->format("d-m-Y"),
    ];
  }

  public function headings(): array {
    return [
      '#',
      __('admin/newsletter.t_email'),
      __('admin/newsletter.t_date_add'),
    ];
  }

}
